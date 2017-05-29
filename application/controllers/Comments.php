<?php

    class Comments extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('link_model');
            $this->load->model('vote_model');
            $this->load->model('report_model');
            $this->load->model('favourite_model');
            $this->load->model('topic_model');
            $this->load->model('notification_model');
        }

        public function view()
        {
            $id = $this->uri->segment(4);
            $this->data['base_url'] = base_url('t/'.$this->uri->segment(2).'/');

            $this->data['link_item'] = $this->link_model->retrieve_link($id);
            $this->data['reply'] = $this->link_model->retrieve_reply_by_id($id);
            $this->data['tree'] = $this->link_model->retrieve_reply_tree_by_id($id); //$pid

            if (empty($this->data['link_item'])) {
                show_404(); //The page does not exist
            }

            $this->data['link_item']['seo_segment'] = str_replace(" ", "-", strtolower(implode(' ', array_slice(preg_split('/\s+/', preg_replace('/[^a-zA-Z0-9ÇŞĞÜÖİçşğüöı\s]+/', '', $this->data['link_item']['title'])), 0, 6))));
            if (empty($this->uri->segment(5)) || urldecode($this->uri->segment(5)) != $this->data['link_item']['seo_segment']) {
                redirect('t/'.$this->data['link_item']['topic'].'/yorumlar/'.$id.'/'.$this->data['link_item']['seo_segment'].'/');
            }

            $this->data['title']=$this->data['link_item']['title'].' | '.$this->data['link_item']['topic'];

            $ext = pathinfo(parse_url($this->topic_model->retrieve_topic(urldecode($this->uri->segment(2)))['header_image'], PHP_URL_PATH), PATHINFO_EXTENSION);
            $this->data['header_image'] = base_url('assets/img/topics/'.urldecode($this->uri->segment(2)).'.'.$ext);
            if (!empty($this->data['link_item']['url'])) {
                $ext = pathinfo(parse_url($this->data['link_item']['picurl'], PHP_URL_PATH), PATHINFO_EXTENSION);
                $this->data['og_image'] = base_url('assets/img/link_thumbnails/'.$id.'_thumb.'.$ext);
            } else {
                $this->data['og_image'] = base_url('assets/img/icons/1715-rect.png');
            }
            if (!empty($this->data['link_item']['text'])) {
                $this->data['description'] = $this->data['link_item']['text'];
            }

            $this->load->view('templates/header', $this->data);
            $this->load->view('comments/view', $this->data);
            $this->load->view('templates/side');
            $this->load->view('templates/footer');
        }

        public function reply_ajax()
        {
            if ($this->input->post('content')) {
                if ($this->data['is_user_logged_in']) {
                    if ($this->link_model->insert_reply()) {
                        if ($this->input->post('is_parent_link') == 1) {
                            $this->link_model->increase_comments();
                            $this->notification_model->insert_notification(0,3);
                        } elseif ($this->input->post('is_parent_link') == 0) {
                            $this->link_model->increase_rply_comments();
                            $this->notification_model->insert_notification(1,3);
                        }
                        echo 1;
                    } else {
                        echo "Bir hata oluştu. Lütfen tekrar deneyin.";
                    }
                } else {
                    echo "Lütfen öncelikle giriş yapın.";
                }
            } else {
                echo "Boş bir yorum/yanıt gönderemezsiniz.";
            }
        }

        public function up()
        {
            if ($this->data['is_user_logged_in']) {
                if (!$this->vote_model->right_to_vote()) {
                    $this->vote_model->insert_vote(1);
                    $this->link_model->up_score();
                    $this->notification_model->insert_notification(0,0);
                    echo 1;
                } else {
                    echo "Bu gönderi için oyunuzu zaten kullandınız.";
                }
            } else {
                echo "Lütfen öncelikle giriş yapın.";
            }
        }

        public function down()
        {
            if ($this->data['is_user_logged_in']) {
                if (!$this->vote_model->right_to_vote()) {
                    $this->vote_model->insert_vote(0);
                    $this->link_model->down_score();
                    $this->notification_model->insert_notification(0,1);
                    echo 1;
                } else {
                    echo "Bu gönderi için oyunuzu zaten kullandınız.";
                }
            } else {
                echo "Lütfen öncelikle giriş yapın.";
            }
        }

        public function rply_up()
        {
            if ($this->data['is_user_logged_in']) {
                if (!$this->vote_model->right_to_rply_vote()) {
                    $this->vote_model->insert_rply_vote(1);
                    $this->link_model->rply_up_score();
                    $this->notification_model->insert_notification(1,0);
                    echo 1;
                } else {
                    echo "Bu yorum/yanıt için oyunuzu zaten kullandınız.";
                }
            } else {
                echo "Lütfen öncelikle giriş yapın.";
            }
        }

        public function rply_down()
        {
            if ($this->data['is_user_logged_in']) {
                if (!$this->vote_model->right_to_rply_vote()) {
                    $this->vote_model->insert_rply_vote(0);
                    $this->link_model->rply_down_score();
                    $this->notification_model->insert_notification(1,1);
                    echo 1;
                } else {
                    echo "Bu yorum/yanıt için oyunuzu zaten kullandınız.";
                }
            } else {
                echo "Lütfen öncelikle giriş yapın.";
            }
        }

        public function report_link()
        {
            if ($this->data['is_user_logged_in']) {
                if (!$this->report_model->right_to_report_link()) {
                    $title = $this->report_model->insert_report_link();
                    $this->link_model->increase_link_reported();
                    echo '1 '.$title;
                } else {
                    echo "Bu gönderiyi zaten şikayet ettiniz.";
                }
            } else {
                echo "Lütfen öncelikle giriş yapın.";
            }
        }

        public function report_reply()
        {
            if ($this->data['is_user_logged_in']) {
                if (!$this->report_model->right_to_report_reply()) {
                    $username = $this->report_model->insert_report_reply();
                    $this->link_model->increase_reply_reported();
                    echo '1 '.$username;
                } else {
                    echo "Bu yorumu/yanıtı zaten şikayet ettiniz.";
                }
            } else {
                echo "Lütfen öncelikle giriş yapın.";
            }
        }

        public function favourite_link()
        {
            if ($this->data['is_user_logged_in']) {
                if (!$this->favourite_model->right_to_unfavourite_link()) {
                    $this->favourite_model->insert_favourite_link();
                    $this->favourite_model->increase_link_favorited();
                    $this->notification_model->insert_notification(0,2);
                    echo 1;
                } else {
                    echo "Bu gönderi zaten favorilerinizde.";
                }
            } else {
                echo "Lütfen öncelikle giriş yapın.";
            }
        }

        public function unfavourite_link()
        {
            if ($this->data['is_user_logged_in']) {
                if ($this->favourite_model->right_to_unfavourite_link()) {
                    $this->favourite_model->delete_favourite_link();
                    $this->favourite_model->decrease_link_favorited();
                    echo 1;
                } else {
                    echo "Bu gönderiyi zaten favorilerinizden çıkardınız.";
                }
            } else {
                echo "Lütfen öncelikle giriş yapın.";
            }
        }

        public function favourite_reply()
        {
            if ($this->data['is_user_logged_in']) {
                if (!$this->favourite_model->right_to_unfavourite_reply()) {
                    $this->favourite_model->insert_favourite_reply();
                    $this->favourite_model->increase_reply_favorited();
                    $this->notification_model->insert_notification(1,2);
                    echo 1;
                } else {
                    echo "Bu yorum/yanıt zaten favorilerinizde.";
                }
            } else {
                echo "Lütfen öncelikle giriş yapın.";
            }
        }

        public function unfavourite_reply()
        {
            if ($this->data['is_user_logged_in']) {
                if ($this->favourite_model->right_to_unfavourite_reply()) {
                    $this->favourite_model->delete_favourite_reply();
                    $this->favourite_model->decrease_reply_favorited();
                    echo 1;
                } else {
                    echo "Bu yorumu/yanıtı zaten favorilerinizden çıkardınız.";
                }
            } else {
                echo "Lütfen öncelikle giriş yapın.";
            }
        }

        public function notifications()
        {
            echo json_encode($this->notification_model->retrieve_notifications());
        }

        public function get_unread_notification_count()
        {
            echo $this->notification_model->get_unread_notification_count();
        }
    }

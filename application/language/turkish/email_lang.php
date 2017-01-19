<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_must_be_array'] = 'Eposta doğrulama kuralı dizi olarak gönderilmelidir.';
$lang['email_invalid_address'] = 'Hatalı eposta adresi: %s';
$lang['email_no_from'] = 'Header "Kimden" Hiçbir ile posta göndermek olamaz';
$lang['email_attachment_missing'] = 'Eposta eki bulunamadı: %s';
$lang['email_attachment_unreadable'] = 'Unable to open this attachment: %s';
$lang['email_no_recipients'] = 'Gönderilecek eposta adresi bulunamadı. Eposta adreslerini şu alanlara eklemeniz gerekmektedir: To, Cc, veya Bcc';
$lang['email_send_failure_phpmail'] = 'PHP mail() methodunu kullanarak eposta gönderilemedi. Sunucunuz bu methodu kullanarak eposta gönderecek şekilde konfigüre edilmemiş olabilir.';
$lang['email_send_failure_sendmail'] = 'PHP Sendmail methodunu kullanarak eposta gönderilemedi. Sunucunuz bu methodu kullanarak eposta gönderecek şekilde konfigüre edilmemiş olabilir.';
$lang['email_send_failure_smtp'] = 'PHP SMTP methodunu kullanarak eposta gönderilemedi. Sunucunuz bu methodu kullanarak eposta gönderecek şekilde konfigüre edilmemiş olabilir.';
$lang['email_sent'] = 'Mesajınız, %s protokolü kullanılarak başarılı bir şekilde gönderildi.';
$lang['email_no_socket'] = 'Sendmail için socket açılamadı. Lütfen ayarları kontrol ediniz.';
$lang['email_no_hostname'] = 'SMTP sunucu bilgisi girmediniz.';
$lang['email_smtp_error'] = 'SMTP hatası oluştu: %s';
$lang['email_no_smtp_unpw'] = 'Hata: SMTP kullanıcı adı ve parolası girmeniz gerekmektedir.';
$lang['email_failed_smtp_login'] = 'AUTH LOGIN komutu gönderilirken hata oluştu. Hata: %s';
$lang['email_smtp_auth_un'] = 'Kullanıcı adı doğrulanamadı. Hata: %s';
$lang['email_smtp_auth_pw'] = 'Parola doğrulanamadı. Hata: %s';
$lang['email_smtp_data_failure'] = 'Veri gönderilemedi. Hata: %s';
$lang['email_exit_status'] = 'Çıkış durum kodu: %s';
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

$lang['db_invalid_connection_str'] = 'Veritabanı ayarları hatalı yapılandırılmış.';
$lang['db_unable_to_connect'] = 'Veritabanıyla bağlantı kurulamıyor.';
$lang['db_unable_to_select'] = '%s veritabanı seçilemedi';
$lang['db_unable_to_create'] = '%s veritabanı oluşturulamadı.';
$lang['db_invalid_query'] = 'Hatalı sorgu.';
$lang['db_must_set_table'] = 'Sorgularınızda kullanmak için veritabanı tablosunu ayarlamanız gerekmektedir.';
$lang['db_must_use_set'] = 'Girişi güncellemek istiyorsanız "set" methodunu kullanmanız gerekmektedir.';
$lang['db_must_use_index'] = 'Toplu güncelleştirmede eşleşmesi için bir index belirlemelisiniz.';
$lang['db_batch_missing_index'] = 'Toplu güncelleştirme için gönderdiğiniz bir veya daha fazla satır için index belirtmemişsiniz.';
$lang['db_must_use_where'] = 'Update sorguları "where" şartı belirtilmeden çalıştırılamaz.';
$lang['db_del_must_use_where'] = 'Delete sorguları "where" şartı belirtilmeden çalıştırılamaz.';
$lang['db_field_param_missing'] = 'Tablo alanlarını çekmek için tablo ismi parametre olarak verilmelidir.';
$lang['db_unsupported_function'] = 'Kullandığınız veritabanı bu fonksiyonu desteklememektedir.';
$lang['db_transaction_failure'] = 'Transaction hatası: Rollback uygulandı';
$lang['db_unable_to_drop'] = 'Seçtiğiniz veritabanı kaldırılamadı.';
$lang['db_unsupported_feature'] = 'Kullandığınız veritabanı platformu bu özelliği desteklememektedir.';
$lang['db_unsupported_compression'] = 'Seçtiğiniz dosya sıkıştırma formatı sunucunuz tarafından desteklenmemektedir.';
$lang['db_filepath_error'] = 'Seçtiğiniz dosya yoluna veri yazılamadı.';
$lang['db_invalid_cache_path'] = 'Seçtiğiniz önbellek klasörü geçersiz veya yazılabilir değil.';
$lang['db_table_name_required'] = 'Bu operasyon için bir tablo ismi gereklidir.';
$lang['db_column_name_required'] = 'Bu operasyon için bir kolon ismi gereklidir.';
$lang['db_column_definition_required'] = 'Bu operasyon için bir tablo tanımı gereklidir.';
$lang['db_unable_to_set_charset'] = '%s kullanıcı karakter seti ayarlanamadı. ';
$lang['db_error_heading'] = 'Veritabanında bir hata oluştu.';

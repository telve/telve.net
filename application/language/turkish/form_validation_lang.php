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

$lang['form_validation_required']		= "{field} alanının doldurulması zorunludur.";
$lang['form_validation_isset']			= "{field} alanına bir veri girilmelidir.";
$lang['form_validation_valid_email']		= "{field} alanına geçerli bir eposta adresi girilmelidir.";
$lang['form_validation_valid_emails']		= "{field} alanına girdiğiniz tüm eposta adresleri geçerli olmalıdır.";
$lang['form_validation_valid_url']		= "{field} alanına geçerli bir internet adresi girilmelidir.";
$lang['form_validation_valid_ip']		= "{field} alanına geçerli bir IP adresi girmelisiniz.";
$lang['form_validation_min_length']		=  "{field} alanına en az {param} karakter girilmelidir."; 
$lang['form_validation_max_length']		= "{field} alanına en fazla {param} karakter girilmelidir."; 
$lang['form_validation_exact_length']		= "{field} alanına tam olarak {param} karakter girilmelidir.";
$lang['form_validation_alpha']			= "{field} alanına sadece alfabedeki karakterler girilmelidir.";
$lang['form_validation_alpha_numeric']		= "{field} alanına sadece alfa-nümerik karakterler girilmelidir.";
$lang['form_validation_alpha_numeric_spaces']	= 'The {field} field may only contain alpha-numeric characters and spaces.';
$lang['form_validation_alpha_dash']		= "{field} alanına sadece alfa-nümerik karakterler, altçizgi ve kesikli çizgi girilmelidir.";
$lang['form_validation_numeric']		= "{field} alanına sadece sayı(lar) girilmelidir.";
$lang['form_validation_is_numeric']		= "{field} alanına sadece sayı(lar) girilmelidir.";
$lang['form_validation_integer']		= "{field} alanına sadece tam sayı girilmelidir.";
$lang['form_validation_regex_match']		= "{field} alanına uygun formatta veri girmelisiniz.";
$lang['form_validation_matches']		= "{field} alanındaki veri {param} alanındaki veri ile eşleşmiyor.";
$lang['form_validation_differs']		= 'The {field} field must differ from the {param} field.';
$lang['form_validation_is_unique'] 		= "{field} alanına eşsiz bir değer girmelisiniz.";
$lang['form_validation_is_natural']		= "{field} alanına sadece sayı(lar) girilmelidir.";
$lang['form_validation_is_natural_no_zero']	= "{field} alanına sadece sıfırdan büyük sayı girilmelidir.";
$lang['form_validation_decimal']		= "{field} alanına sadece ondalık sayı girilmelidir.";
$lang['form_validation_less_than']		= "{field} alanına sadece {param} sayısından küçük değer girilmelidir.";
$lang['form_validation_less_than_equal_to']	= 'The {field} field must contain a number less than or equal to {param}.';
$lang['form_validation_greater_than']		= "{field} alanına sadece {param} sayısından büyük değer girilmelidir.";
$lang['form_validation_greater_than_equal_to']	= 'The {field} field must contain a number greater than or equal to {param}.';
$lang['form_validation_error_message_not_set']	= 'Unable to access an error message corresponding to your field name {field}.';
$lang['form_validation_in_list']		= 'The {field} field must be one of: {param}.';

<?php

namespace App\Helpers;

class Main{
    public static function ShowUploadImageHtml($id, $value, $name)
    {
        $html = '<div class="input-group-image">';
        $html .= '<div class="preview-image-container" style="margin-right: 10px;">';
        $html .= ($value) ? '<img src="' . ((!empty($value)) ? asset($value) : '') . '" id="' . e($id) . '_preview" style="max-width: 250px; max-height: 190px;">' : '<img id="' . e($id) . '_preview" style="max-width: 250px; max-height: 180px; display: none;">';
        $html .= '</div>';
        $html .= '<input type="hidden" class="form-control" id="' . e($id) . '" name="' . e($name) . '" value="' . e($value) . '">';
        $html .= '<span class="input-group-btn">';
        $html .= '<button type="button" class="btn btn-' . (($value) ? 'danger' : 'warning') . ' upload-button btn-xs mt-2" data-inputid="' . e($id) . '">' . (($value) ? 'Change Image' : 'Upload Image') . '</button>';
        $html .= '</span>';
        $html .= '<input type="file" id="' . e($id) . '_file" style="display: none">'; // Hidden file input
        $html .= '</div>';
        return $html;
    }
}

?>
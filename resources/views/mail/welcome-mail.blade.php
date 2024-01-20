<?php
/**
 * @author Rufusy Idachi <idachirufus@gmail.com>
 * @date: 1/20/2024
 * @time: 2:48 PM
 */
?>
@component("mail::message")
# Welcome {{ $name }}!!

Thanks, <br>
{{ config('app.name') }}
@endcomponent


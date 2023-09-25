@php
$shop_info = shop_info();
@endphp
<div class="footer-wrapper">
    <div class="footer-section f-section-1">
        <p class="">Copyright © 2021 <a target="_blank" href="#">{{ $shop_info ? $shop_info->shop_name : '' }}</a>, All
            rights reserved.</p>
    </div>
    <div class="footer-section f-section-2">
        <p class="https://www.desseinlab.com/">Design and Developed by
            <a href="">Dessein Lab</a>
        </p>
    </div>
</div>
<?php
    if($_GET){
        $class_id = $_GET['ncw_file'];

    }
?>
<script src="<?= base_url('assets/js/jquery-1.12.3.min.js') ?>"></script>

<div class="bg" id="main-background-full"></div>
<div class="title"></div>

<style>
    iframe{
        position: relative;
        left: 0%;
        top:10%;
        width: 100%;
        height: 90%;
        background: white;
        outline: none;
        border:none;
    }
</style>
<iframe src="<?=base_url().'assets/js/toolset/video_player/docviewer.php?ncw_file='.$class_id.'&&base='.base_url();?>"></iframe>
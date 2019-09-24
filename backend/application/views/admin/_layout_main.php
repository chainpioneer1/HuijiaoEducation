<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("admin/components/page_header"); ?>
<?php $this->load->view($subcss); ?>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
    <?php $this->load->view("admin/components/page_topbar"); ?>

    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">

        <?php $this->load->view("admin/components/page_menu"); ?>

        <?php $this->load->view($subview); ?>
    </div>
    <!-- END CONTAINER -->

    <?php $this->load->view("admin/components/page_footer"); ?>
</div>

<?php $this->load->view("admin/components/page_endscript"); ?>
<?php $this->load->view($subscript); ?>

</body>
<script>
    function FormatNumberLength(num, length) {
        var r = "" + num;
        while (r.length < length) {
            r = "0" + r;
        }
        return r;
    }
</script>
</html>











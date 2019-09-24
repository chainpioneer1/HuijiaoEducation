
<script src="<?= base_url('assets/admin/global/scripts/datatable.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/global/plugins/datatables/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')?>" type="text/javascript"></script>

<!--itbh-pms-code-->
<script src="<?= base_url('assets/admin/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/global/plugins/bootstrap-modal/js/bootstrap-modal.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/jquery.table2excel.js') ?>" type="text/javascript"></script>

<script src="<?= base_url('assets/admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>" type="text/javascript"></script>


<script>
    function export_table(filename) {
        $("#main_tbl").table2excel({
            exclude: ".noExl",
            name: "Excel Document Name",
            filename: filename,
            fileext: ".xls",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs: true
        });
    }

</script>

<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Рынок перевозок России по данным нашего сайта</h3>
    </div>
    <div class="box-body">
        <canvas id="pieChart" style="height: 393px; width: 786px;" height="393" width="786"></canvas>
    </div>
    <!-- /.box-body -->
</div>
<script>
    var obj = <?php echo json_encode($allcompany); ?>;
</script>
<h1>Posts Page</h1>

<div class="container">
    <div class="row">
        <?php foreach($data as $row): ?>
        <div class="col-10 mx-auto">
            <h3><?php echo $row->name; ?></h3>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="col-10 offset-1 col-md-4 offset-md-0 col-lg-2 bg-dark-subtle py-4 rounded-4 mt-3">
    <h2 class="text-center">filters</h2>
    <hr>
    <div class="mb-2">
        <label for="" class="form-label">Category</label>
        <select name="" id="category" class="form-select">
            <option value="0">All categories</option>
            <?php
            $rs = Database::search("SELECT * FROM `category`");
            while ($row = $rs->fetch_assoc()) {
            ?>
                <option value="<?php echo ($row['cat_id']) ?>"><?php echo ($row['cat_name']) ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="" class="form-label">Brand</label>
        <select name="" id="brand" class="form-select">
            <option value="0">All brands</option>
            <?php
            $rs = Database::search("SELECT * FROM `brand`");
            while ($row = $rs->fetch_assoc()) {
            ?>
                <option value="<?php echo ($row['brand_id']) ?>"><?php echo ($row['brand_name']) ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="" class="form-label">Color</label>
        <select name="" id="color" class="form-select">
            <option value="0">All colors</option>
            <?php
            $rs = Database::search("SELECT * FROM `color`");
            while ($row = $rs->fetch_assoc()) {
            ?>
                <option value="<?php echo ($row['color_id']) ?>"><?php echo ($row['color_name']) ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="" class="form-label">Size</label>
        <select name="" id="size" class="form-select">
            <option value="0">All sizes</option>
            <?php
            $rs = Database::search("SELECT * FROM `size`");
            while ($row = $rs->fetch_assoc()) {
            ?>
                <option value="<?php echo ($row['size_id']) ?>"><?php echo ($row['size_name']) ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="" class="form-label">Price From</label>
        <input type="number" name="" id="priceFrom" class="form-control">
    </div>
    <div class="mb-2">
        <label for="" class="form-label">Price To</label>
        <input type="number" name="" id="priceTo" class="form-control">
    </div>

    <div class="col-12 d-grid">
        <!-- DOM tree did't work proper and in that case I have to use inline JavaFunction -->
        <button class="btn btn-outline-info filter" onclick="filter(1);">FILTER</button> 
    </div>
</div>
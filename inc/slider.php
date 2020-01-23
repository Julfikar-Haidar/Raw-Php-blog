<div class="slidersection templete clear">
        <div id="slider">
              <?php
                        $query = "select * from tbl_slider limit 4";
                        $slider = $db->select($query);
                        if ($slider) {
                            while ($result =$slider->fetch_assoc()) {
                                ?>
            <a href="<?php echo $result['link'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['title']; ?>" title="<?php echo $result['title']; ?>" /></a>
                        <?php }}?>
        </div>

</div>
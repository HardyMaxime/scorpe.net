<?php 
    $responsive_table = DefaultController::field_value("carac_not_responsive_table", get_the_ID()) ?? false;
    $table = (isset($args['table']) ? $args['table'] : false );
?>
<details class="product-details" open >
    <summary class="title-with-arrow-icon white-arrow" >
        <div class="details-title"><?= $args['title']; ?></div>
    </summary>
    <div class="details-content<?= ($responsive_table ? " not-responsive" : ""); ?>" open>
        <p>
            <?= $args['content']; ?>
        </p>
        <?php if($table): ?>
            <div class="details-table" >
                <table>
                    <thead>
                        <tr>
                            <?php foreach($table['header'] as $row): ?>
                                <th>
                                    <?= $row["c"]; ?>
                                </th>
                            <?php endforeach;?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($table['body'] as $key => $tr): ?>
                            <tr>
                                <?php foreach($tr as $key => $td): ?>
                                    <td>
                                        <?= $td["c"]; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        <?php if(have_rows("more_product_characteristic_tables", get_the_ID())): ?>
            <?php while(have_rows("more_product_characteristic_tables", get_the_ID())): the_row();
                    $table = get_sub_field('item');
                ?>
                <div class="details-table" >
                    <table>
                        <thead>
                            <tr>
                                <?php foreach($table['header'] as $row): ?>
                                    <th>
                                        <?= $row["c"]; ?>
                                    </th>
                                <?php endforeach;?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($table['body'] as $key => $tr): ?>
                                <tr>
                                    <?php foreach($tr as $key => $td): ?>
                                        <td>
                                            <?= $td["c"]; ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</details>
<?php
$table = $args['table'] ?: [];
if($table): ?>
    <div class="table-wrapper" >
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
<?php if(have_rows("pdf_more_product_characteristic_tables", get_the_ID())): ?>
    <?php while(have_rows("pdf_more_product_characteristic_tables", get_the_ID())): the_row();
            $table = get_sub_field('item');
        ?>
        <div class="table-wrapper" >
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
<?php else: ?>
    <?php if(have_rows("more_product_characteristic_tables", get_the_ID())): ?>
        <?php while(have_rows("more_product_characteristic_tables", get_the_ID())): the_row();
            $table = get_sub_field('item');
        ?>
            <div class="table-wrapper" >
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
<?php endif; ?>
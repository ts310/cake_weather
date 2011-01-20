<h1>Weather</h1>
<?php if (!empty($data)): ?>
<table class="weather_table">
    <tr>
        <th><?php echo __('City name') ?></th>
        <th><?php echo __('City name') ?></th>
        <th><?php echo __('Conditions') ?></th>
        <th><?php echo __('Temperature') ?></th>
        <th><?php echo __('Image') ?></th>
        <th><?php echo __('Sunrise') ?></th>
        <th><?php echo __('Sunset') ?></th>
        <th></th>
    </tr>
    <?php foreach ($data as $item): ?>
    <tr>
        <td><?php echo $item['WeatherCity']['display_name'] ?></td>
        <td><?php echo $item['WeatherCity']['name'] ?></td>
        <td><?php echo $item['WeatherCurrent']['conditions'] ?></td>
        <td><?php echo $item['WeatherCurrent']['temperature'] ?><?php echo $item['WeatherCurrent']['units_temp'] ?></td>
        <td><?php echo $this->Html->image($item['WeatherCurrent']['condition_image']) ?></td>
        <td><?php echo $item['WeatherCurrent']['sunrise'] ?></td>
        <td><?php echo $item['WeatherCurrent']['sunset'] ?></td>
        <td><?php echo $this->Html->link('[X]', array('action' => 'delete', $item['WeatherCurrent']['id'])) ?></td>
    </tr>
    <?php endforeach ?>
</table>
<div class="paginator">
    <?php 
    echo $this->Paginator->numbers();
    echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled'));
    echo $this->Paginator->next(' Next »', null, null, array('class' => 'disabled'));
    echo $this->Paginator->counter();
    ?>
</div>
<?php endif ?>

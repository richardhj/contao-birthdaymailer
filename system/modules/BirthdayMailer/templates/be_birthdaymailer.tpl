
<div id="tl_buttons"><?php echo $this->backLink; ?></div>

<h2 id="index_complete"><?php echo $this->headline; ?></h2>

<div id="tl_soverview">

<div id="tl_messages">
  <h2><?php echo $this->sendingHeadline; ?></h2>
  <p class="tl_confirm"><?php echo $this->success; ?></p>
<?php if ($this->failed): ?> 
  <p class="tl_task_due"><?php echo $this->failed; ?></p>
<?php endif; ?> 
</div>

<?php if ($this->failed): ?>
<table summary="Failure overview">
<thead>
	<tr>
		<td colspan="4" class="headline">
			<div><?php echo $this->failureHeadline; ?></div>
		</td>
	</tr>
</thead>
<tbody>
<?php foreach ($this->failureArray as $failure): ?>
  <tr onmouseout="Theme.hoverRow(this, 0);" onmouseover="Theme.hoverRow(this, 1);">
    <td class="col_1">ID <?php echo $failure['id']; ?></td>
    <td class="col_1"><?php echo $failure['firstname']; ?></td>
    <td class="col_1"><?php echo $failure['lastname']; ?></td>
    <td class="col_1"><?php echo $failure['email']; ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<div id="tl_moverview">
  <p class="tl_update"><?php echo $this->failureMessage; ?></p>
</div>
<?php endif; ?>

<?php if ($this->developerMessage): ?>
<div id="tl_moverview">
  <p class="tl_update"><?php echo $this->developerMessage; ?></p>
</div>
<?php endif; ?>

</div>
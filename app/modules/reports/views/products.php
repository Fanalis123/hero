<?=$this->load->view(branded_view('cp/header'), array('head_files' => '<script type="text/javascript" src="' . branded_include('js/report.products.js') . '"></script>'));?>
<h1>Product Orders</h1>
<?=$this->dataset->table_head();?>
<?
if (!empty($this->dataset->data)) {
	foreach ($this->dataset->data as $row) {
	?>
		<tr <? if (isset($row['shipped']) and empty($row['shipped'])) { ?>class="highlight"<? } ?>>
			<td><?=$row['invoice_id'];?></td>
			<td><?=$row['name'];?></td>
			<td><?=$row['quantity'];?></td>
			<td><?=$row['date'];?></td>
			<td><input type="radio" class="shipped_no" rel="<?=$row['order_products_id'];?>" name="shipped_<?=$row['order_products_id'];?>" <? if ($row['shipped'] == FALSE) { ?>checked="checked"<? } ?>value="0" /> No  <input type="radio" class="shipped_yes" rel="<?=$row['order_products_id'];?>" <? if ($row['shipped'] == TRUE) { ?>checked="checked"<? } ?> name="shipped_<?=$row['order_products_id'];?>" value="1" /> Yes</td>
			<td>
				<? if (!empty($row['shipping_address'])) { ?>
					<a href="#" class="show_shipping">show address</a>
					<a href="#" class="hide_shipping">hide address</a>
					<div class="shipping_address"><?=format_street_address($row['shipping_address']);?></div>
				<? } else { ?>
				none
				<? } ?>
			</td>
			<td>
				<input type="hidden" name="action_id" value="<?=$row['invoice_id'];?>" />
				<select name="action">
					<option value="0" selected="selected"></option>
					<option value="details">view full invoice</option>
					<option value="profile">view member profile</option
				</select>
				&nbsp;
				<input type="submit" rel="admincp/reports/invoice_actions" class="action button" name="go_action" value="Go" />
			</td>
		</tr>
	<?
	}
}
else {
?>
<tr><td colspan="7">Empty data set.</td></tr>
<?
}	
?>
<?=$this->dataset->table_close();?>
<?=$this->load->view(branded_view('cp/footer'));?>
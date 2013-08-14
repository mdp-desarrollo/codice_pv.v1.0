<? if(isset($errors)){?>
<?foreach($errors as $item){?>
<p style="color:red"><?=$item?></p>
<?}?>
<?}?>

<div>
    <form method="post" action="">
        <select name="parentId">
            <?foreach($categories as $item) {?>
            <option value="<?=$item['id']?>"><?=str_repeat('&nbsp;', 4*$item['level']).htmlspecialchars($item['name'])?></option>
            <?}?>
        </select>
        <input type="text" name="categoryName">
		<input type="text" name="url">
        <input type="submit" value="Создать" name="btnsubmit">
    </form>
</div>

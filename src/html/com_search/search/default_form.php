<?php defined('_JEXEC') or die('Restricted access'); ?>

<form id="searchForm" action="<?php echo JRoute::_( 'index.php?option=com_search' );?>" method="post" name="searchForm">
	<div class="searchoptions<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
		<table>
			<tr class="keyword">
				<td nowrap="nowrap">
					<label for="search_searchword">
						<?php echo JText::_( 'Search Keyword' ); ?>:
					</label>
					<input type="text" name="searchword" id="search_searchword" size="30" maxlength="20" value="<?php echo $this->escape($this->searchword); ?>" class="inputbox" />
					<button name="Search" onClick="this.form.submit()" class="button"><?php echo JText::_( 'Search' );?></button>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $this->lists['searchphrase']; ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="ordering">
						<?php echo JText::_( 'Ordering' );?>:
					</label>
					<?php echo $this->lists['ordering'];?>
				</td>
			</tr>
			<?php if ($this->params->get( 'search_areas', 1 )) : ?>
			<tr>
				<td>
					<?php echo JText::_( 'Search Only' );?>:
					<?php foreach ($this->searchareas['search'] as $val => $txt) :
						$checked = is_array( $this->searchareas['active'] ) && in_array( $val, $this->searchareas['active'] ) ? 'checked="checked"' : '';
					?>
					<input type="checkbox" name="areas[]" value="<?php echo $val;?>" id="area_<?php echo $val;?>" <?php echo $checked;?> />
						<label for="area_<?php echo $val;?>">
							<?php echo JText::_($txt); ?>
						</label>
					<?php endforeach; ?>
				</td>
			</tr>
			<?php endif; ?>
		</table>
	</div>

  <table class="searchintro<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
    <tr class="top">
      <td>
        <?php echo JText::_( 'Search Keyword' ) .': <b>'. $this->escape($this->searchword) .'</b>'; ?>
      </td>
      <td class="text-right">
        <?php if($this->total > 0) : ?>
          <label for="limit">
            <?php echo JText::_( 'Display Num' ); ?>
          </label>
          <div class="search-limit-box">
			  <?php echo $this->pagination->getLimitBox( ); ?>
		  </div>
		  <div class="search-pages-box">
			  <?php echo $this->pagination->getPagesCounter(); ?>
		  </div>
        <?php endif; ?>
      </td>
    </tr>
  </table>

<input type="hidden" name="task"   value="search" />
</form>
<?define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?if(!$_GET['skip_preview']):?>
<a href="#" class="close jqmClose"><i></i></a>
<div class="form">
	<div class="form_head">
		<h2><?=\Bitrix\Main\Localization\Loc::getMessage('FAST_VIEW');?></h2>
	</div>
<?endif?>
	<?
	if(htmlspecialcharsbx(isset($_GET['iblock_id'])) && htmlspecialcharsbx($_GET['iblock_id']))
	{
		global $APPLICATION, $arRegion, $arTheme;
		$arRegion = CNextRegionality::getCurrentRegion();
		$arTheme = CNext::GetFrontParametrsValues(SITE_ID);
		$context = \Bitrix\Main\Application::getInstance()->getContext();
    	$request = $context->getRequest();
		$href = $request['item_href'] ?? $result['DETAIL_PAGE_URL']; // from fastViewNav.php
		$url = str_replace('&amp;', '&', $href );
		//$url = htmlspecialcharsbx(urldecode($_GET['item_href']));


		\Bitrix\Main\Loader::includeModule('sale');
		\Bitrix\Main\Loader::includeModule('currency');
		\Bitrix\Main\Loader::includeModule('catalog');?>

		<script>
			var objUrl = parseUrlQuery(),
				url = '<?=$url;?>',
				add_url = '<?=(strpos($url, '?') !== false ? '&' : '?')?>FAST_VIEW=Y';
			<?if ($_GET['fid']):?>
				url = $('#<?=htmlspecialcharsbx($_GET['fid']);?>').find('a.dark_link').attr('href');
				if (url.indexOf('?') !== -1) {
					add_url = '&FAST_VIEW=Y';
				} else {
					add_url = '?FAST_VIEW=Y';
				}
			<?endif;?>
			if('clear_cache' in objUrl)
			{
				if(objUrl.clear_cache == 'Y')
					add_url += '&clear_cache=Y';
			}
			BX.ajax({
				// url: '<?=$url;?>'+add_url,
				url: url+add_url,
				method: 'POST',
				data: BX.ajax.prepareData({'FAST_VIEW':'Y'}),
				dataType: 'html',
				processData: false,
				start: true,
				headers: [{'name': 'X-Requested-With', 'value': 'XMLHttpRequest'}],
				onfailure: function(data) {
					alert('Error connecting server');
				},
				onsuccess: function(html){
					var ob = BX.processHTML(html);
					<?if($_GET['skip_preview'] == true):?>
                    	ob.HTML = ob.HTML.replace(/(calculate-delivery[^>]*?)with_preview/, '$1').replace(/<span class=\"calculate-delivery-preview\"><\/span>/, '');
						$('#fast_view_item').removeClass("sending");
               		 <?endif;?>
					// inject
					BX('fast_view_item').innerHTML = ob.HTML;
					BX.ajax.processScripts(ob.SCRIPT);
					$('#fast_view_item').closest('.form').addClass('init');
					$('.fast_view_frame .form_head h2').html($('#fast_view_item .title.hidden').html());

					initFancybox()
					initCountdown();
					setBasketStatusBtn();
					InitFlexSlider();
					InitZoomPict($('#fast_view_item .zoom_picture'));

					// init calculate delivery with preview
					if($('#fast_view_item .item_main_info.noffer').length){
						initCalculatePreview();
					}

					setTimeout(function(){
						showTotalSummItem('Y');
					}, 100);

					$(window).scroll();
				}
			})
			$('.jqmClose').on('click', function(e){
				e.preventDefault();
				$(this).closest('.jqmWindow').jqmHide();
			})
		</script>
		<?if(!$_GET['skip_preview']):?>
		<div id="fast_view_item"><div class="loading_block"></div></div>
		<?endif?>
	<?}?>
<?if(!$_GET['skip_preview']):?>
</div>
<?endif?>

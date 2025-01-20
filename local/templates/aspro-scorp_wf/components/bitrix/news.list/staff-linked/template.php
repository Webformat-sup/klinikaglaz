<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?
if(count($arResult['ITEMS']) < 2){
	$arParams['VIEW_TYPE'] = 'list';
}
?>
<div class="item-views <?=$arParams['VIEW_TYPE']?> <?=($arParams['IMAGE_POSITION'] ? 'image_'.$arParams['IMAGE_POSITION'] : '')?> staff <?=($templateName = $component->{'__template'}->{'__name'})?>">
	<?// top pagination?>
	<?if($arParams['DISPLAY_TOP_PAGER']):?>
		<?=$arResult['NAV_STRING']?>
	<?endif;?>

	<?if($arResult['ITEMS']):?>
		<div id="carousel_staff">
			<div class="row items swiper-wrapper">
				<?foreach($arResult['ITEMS'] as $i => $arItem):?>
					<?
					// edit/add/delete buttons for edit mode
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					// use detail link?
					$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
					// show preview picture?
					$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
					$imageSrc = ($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['SRC'] : false);
					$imageDetailSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
					?>
					<?ob_start();?>
					
						<?// element name?>
						<?if(strlen($arItem['FIELDS']['NAME'])):?>
							<div class="title">
								<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
									<?=$arItem['NAME']?>
								<?if($bDetailLink):?></a><?endif;?>
							</div>
						<?endif;?>

						<?// element post?>
						<?if(strlen($arItem['DISPLAY_PROPERTIES']['POST']['VALUE'])):?>
							<div class="post"><?=$arItem['DISPLAY_PROPERTIES']['POST']['VALUE']?></div>
							<?unset($arItem['DISPLAY_PROPERTIES']['POST']);?>
						<?endif;?>

						<?// element preview text?>
						<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT'])):?>
							<div class="previewtext">
								<?if($arItem['PREVIEW_TEXT_TYPE'] == 'text'):?>
									<p><?=$arItem['FIELDS']['PREVIEW_TEXT']?></p>
								<?else:?>
									<?=$arItem['FIELDS']['PREVIEW_TEXT']?>
								<?endif;?>
							</div>
						<?endif;?>

						<?// element display properties?>
						<?if($arItem['DISPLAY_PROPERTIES']):?>
							<hr/>
							<div class="properties">
								<?foreach($arItem['DISPLAY_PROPERTIES'] as $PCODE => $arProperty):?>
									<div class="property">
										<?if($arProperty['XML_ID']):?>
											<i class="fa <?=$arProperty['XML_ID']?>"></i>&nbsp;
										<?else:?>
											<?=$arProperty['NAME']?>:&nbsp;
										<?endif;?>
										<?if(is_array($arProperty['DISPLAY_VALUE'])):?>
											<?$val = implode('&nbsp;/&nbsp;', $arProperty['DISPLAY_VALUE']);?>
										<?else:?>
											<?$val = $arProperty['DISPLAY_VALUE'];?>
										<?endif;?>
										<?if($PCODE == 'SITE'):?>
											<!--noindex-->
											<?=str_replace("href=", "rel='nofollow' target='_blank' href=", $val);?>
											<!--/noindex-->
										<?elseif($PCODE == 'EMAIL'):?>
											<a href="mailto:<?=$val?>"><?=$val?></a>
										<?else:?>
											<?=$val?>
										<?endif;?>
									</div>
								<?endforeach;?>
							</div>
							<?if($arParams['FORM_ID'] && $arParams['VIEW_TYPE'] == 'block'){?>
								<div class="form-block">
									<div class="buttom-wrapp">
										<div class="btn-custom-sign" data-event="jqm" data-param-id="5" data-name="order_services" data-autoload-service="<?=$arItem['NAME']?>">Записаться</div>
									</div>
								</div>
							<?}?>
						<?endif;?>
					<?$textPart = ob_get_clean();?>

					<?ob_start();?>
						<?if($bImage):?>
							<div class="image">
								<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="blink">
								<?elseif($arItem['FIELDS']['DETAIL_PICTURE']):?><a href="<?=$imageDetailSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-inside fancybox">
								<?endif;?>
									<img src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-responsive" />
								<?if($bDetailLink):?></a>
								<?elseif($arItem['FIELDS']['DETAIL_PICTURE']):?><span class="zoom"><i class="fa fa-16 fa-white-shadowed fa-search"></i></span></a>
								<?endif;?>
							</div>
						<?endif;?>
					<?$imagePart = ob_get_clean();?>

					<div class="swiper-slide">
					<?if($arParams['VIEW_TYPE'] == 'list'):?>
						<div class="col-md-12">
							<div class="item<?=($bImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
								<div class="row">
									<?if(!$bImage):?>
										<div class="col-md-12"><div class="text"><?=$textPart?></div></div>
									<?elseif($arParams['IMAGE_POSITION'] == 'right'):?>
										<div class="col-md-9 col-sm-9 col-xs-12"><div class="text"><?=$textPart?></div></div>
										<div class="col-md-3 col-sm-3 col-xs-12"><?=$imagePart?></div>
									<?else:?>
										<div class="col-md-3 col-sm-3 col-xs-12"><?=$imagePart?></div>
										<div class="col-md-9 col-sm-9 col-xs-12"><div class="text"><?=$textPart?></div></div>
									<?endif;?>
								</div>
							</div>
						</div>
					<?elseif($arParams['VIEW_TYPE'] == 'table'):?>
						<div class="col-md-<?=floor(12 / $arParams['COUNT_IN_LINE'])?> col-sm-<?=floor(12 / round($arParams['COUNT_IN_LINE'] / 2))?>">
							<div class="item<?=($bImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
								<div class="row">
									<div class="col-md-12">
										<?if(!in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])):?>
											<div class="text"><?=$textPart?></div>
										<?else:?>
											<?=$imagePart?>
											<div class="text"><?=$textPart?></div>
										<?endif;?>
									</div>
								</div>
							</div>
						</div>
					<?elseif($arParams['VIEW_TYPE'] == 'block'):?>
						<div class="item-wrapp">
							<div class="item" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
								<?if(!in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])):?>
									<div class="text"><?=$textPart?></div>
								<?else:?>
									<?=$imagePart?>
									<div class="text"><?=$textPart?></div>
								<?endif;?>
							</div>
							<?if($arParams['FORM_ID']){?>
								<div class="form-block mobile">
									<div class="buttom-wrapp">
										<div class="btn-custom-sign" data-event="jqm" data-param-id="5" data-name="order_services" data-autoload-service="<?=$arItem['NAME']?>">Записаться</div>
									</div>
								</div>
							<?}?>
						</div>
					<?endif;?>
					</div>
				<?endforeach;?>
			</div>
			<div class="visible-xs visible-sm">
				<?/*<div class="swiper-pagination"></div>*/?>
				<div class="swiper-button-prev">
					<svg width="79" height="15" viewBox="0 0 79 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M39.48 5.712V0.799999H40.6V12H39.48V6.768H33.4V12H32.28V0.799999H33.4V5.712H39.48ZM49.875 5.568V4H50.931V12H49.875V10.432C49.139 11.6053 48.0617 12.192 46.643 12.192C45.5017 12.192 44.5257 11.7867 43.715 10.976C42.915 10.1653 42.515 9.17333 42.515 8C42.515 6.82667 42.915 5.83467 43.715 5.024C44.5257 4.21333 45.5017 3.808 46.643 3.808C48.0617 3.808 49.139 4.39467 49.875 5.568ZM44.483 10.256C45.091 10.864 45.8377 11.168 46.723 11.168C47.6083 11.168 48.355 10.864 48.963 10.256C49.571 9.62667 49.875 8.87467 49.875 8C49.875 7.11467 49.571 6.368 48.963 5.76C48.355 5.14133 47.6083 4.832 46.723 4.832C45.8377 4.832 45.091 5.14133 44.483 5.76C43.875 6.368 43.571 7.11467 43.571 8C43.571 8.87467 43.875 9.62667 44.483 10.256ZM57.2949 7.888C58.2229 8.24 58.6869 8.88 58.6869 9.808C58.6869 10.48 58.4255 11.0453 57.9029 11.504C57.4015 11.9627 56.6655 12.192 55.6949 12.192C54.0735 12.192 53.0175 11.552 52.5269 10.272L53.4229 9.744C53.7642 10.6933 54.5215 11.168 55.6949 11.168C56.3029 11.168 56.7775 11.04 57.1189 10.784C57.4602 10.5173 57.6309 10.1707 57.6309 9.744C57.6309 9.36 57.4922 9.056 57.2149 8.832C56.9375 8.59733 56.5642 8.48 56.0949 8.48H54.9269V7.456H55.7749C56.2335 7.456 56.5909 7.344 56.8469 7.12C57.1135 6.88533 57.2469 6.56533 57.2469 6.16C57.2469 5.776 57.0869 5.46133 56.7669 5.216C56.4575 4.96 56.0469 4.832 55.5349 4.832C54.5429 4.832 53.8762 5.232 53.5349 6.032L52.6549 5.52C53.1882 4.37867 54.1482 3.808 55.5349 3.808C56.3882 3.808 57.0602 4.032 57.5509 4.48C58.0522 4.91733 58.3029 5.456 58.3029 6.096C58.3029 6.91733 57.9669 7.51467 57.2949 7.888ZM67.1719 5.568V4H68.2279V12H67.1719V10.432C66.4359 11.6053 65.3585 12.192 63.9399 12.192C62.7985 12.192 61.8225 11.7867 61.0119 10.976C60.2119 10.1653 59.8119 9.17333 59.8119 8C59.8119 6.82667 60.2119 5.83467 61.0119 5.024C61.8225 4.21333 62.7985 3.808 63.9399 3.808C65.3585 3.808 66.4359 4.39467 67.1719 5.568ZM61.7799 10.256C62.3879 10.864 63.1345 11.168 64.0199 11.168C64.9052 11.168 65.6519 10.864 66.2599 10.256C66.8679 9.62667 67.1719 8.87467 67.1719 8C67.1719 7.11467 66.8679 6.368 66.2599 5.76C65.6519 5.14133 64.9052 4.832 64.0199 4.832C63.1345 4.832 62.3879 5.14133 61.7799 5.76C61.1719 6.368 60.8679 7.11467 60.8679 8C60.8679 8.87467 61.1719 9.62667 61.7799 10.256ZM77.1838 4V10.976H78.3038V14.144H77.2478V12H70.7198V14.144H69.6638V10.976H70.6398C71.1837 10.2507 71.4557 9.24267 71.4557 7.952V4H77.1838ZM71.9198 10.976H76.1278V5.024H72.5118V7.952C72.5118 9.18933 72.3144 10.1973 71.9198 10.976Z" fill="#0088cc"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M5.71369 2.72984L5.65962 2.67391C5.42531 2.45987 5.05661 2.4434 4.80162 2.62451L4.74038 2.67391L0.19038 6.83015L0.163472 6.85626L0.127618 6.89654L0.0810377 6.96259L0.0462973 7.02952L0.0232994 7.09207L0.00449011 7.17988L2.07629e-07 7.25L0.00181314 7.29467L0.0131571 7.36918L0.0323307 7.43533L0.0608885 7.50129L0.0948984 7.55917L0.142798 7.62136L0.19038 7.66984L4.74038 11.8261C4.99422 12.058 5.40578 12.058 5.65962 11.8261C5.89393 11.6121 5.91196 11.2753 5.71369 11.0423L5.65962 10.9864L2.2204 7.84375L12.35 7.84375C12.709 7.84375 13 7.57792 13 7.25C13 6.92208 12.709 6.65625 12.35 6.65625L2.2191 6.65625L5.65962 3.51359C5.89393 3.29956 5.91196 2.96276 5.71369 2.72984L5.65962 2.67391L5.71369 2.72984Z" fill="#0088cc"></path></svg>
				</div>
				<div class="swiper-button-next">
					<svg width="87" height="16" viewBox="0 0 87 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.62863 6.192C7.18329 6.42667 7.62063 6.784 7.94063 7.264C8.26063 7.744 8.42063 8.28267 8.42063 8.88C8.42063 9.744 8.11663 10.48 7.50863 11.088C6.90063 11.696 6.16463 12 5.30063 12H0.420625V0.799999H4.93263C5.75396 0.799999 6.46329 1.09867 7.06063 1.696C7.64729 2.28267 7.94063 2.98667 7.94063 3.808C7.94063 4.85333 7.50329 5.648 6.62863 6.192ZM4.93263 1.856H1.54063V5.76H4.93263C5.44463 5.76 5.88729 5.57333 6.26063 5.2C6.63396 4.80533 6.82063 4.34133 6.82063 3.808C6.82063 3.28533 6.63396 2.82667 6.26063 2.432C5.88729 2.048 5.44463 1.856 4.93263 1.856ZM1.54063 10.944H5.30063C5.85529 10.944 6.32463 10.7467 6.70863 10.352C7.10329 9.95733 7.30063 9.46667 7.30063 8.88C7.30063 8.304 7.10329 7.81867 6.70863 7.424C6.32463 7.01867 5.85529 6.816 5.30063 6.816H1.54063V10.944ZM10.1825 4H16.9025V12H15.8465V5.024H11.2385V12H10.1825V4ZM22.8316 3.808C24.0263 3.808 24.981 4.22933 25.6956 5.072C26.4316 5.904 26.7996 6.89067 26.7996 8.032C26.7996 8.08533 26.789 8.25067 26.7676 8.528H19.7436C19.8503 9.328 20.1916 9.968 20.7676 10.448C21.3436 10.928 22.0636 11.168 22.9276 11.168C24.1436 11.168 25.0023 10.7147 25.5036 9.808L26.4316 10.352C26.0796 10.928 25.5943 11.3813 24.9756 11.712C24.3676 12.032 23.6796 12.192 22.9116 12.192C21.653 12.192 20.629 11.7973 19.8396 11.008C19.0503 10.2187 18.6556 9.216 18.6556 8C18.6556 6.79467 19.045 5.79733 19.8236 5.008C20.6023 4.208 21.605 3.808 22.8316 3.808ZM22.8316 4.832C21.9996 4.832 21.301 5.07733 20.7356 5.568C20.181 6.05867 19.8503 6.704 19.7436 7.504H25.7116C25.5943 6.65067 25.269 5.99467 24.7356 5.536C24.181 5.06667 23.5463 4.832 22.8316 4.832ZM32.7674 3.808C33.9087 3.808 34.8794 4.21333 35.6794 5.024C36.49 5.83467 36.8954 6.82667 36.8954 8C36.8954 9.17333 36.49 10.1653 35.6794 10.976C34.8794 11.7867 33.9087 12.192 32.7674 12.192C31.3487 12.192 30.2714 11.6053 29.5354 10.432V15.2H28.4794V4H29.5354V5.568C30.2714 4.39467 31.3487 3.808 32.7674 3.808ZM30.4474 10.256C31.0554 10.864 31.802 11.168 32.6874 11.168C33.5727 11.168 34.3194 10.864 34.9274 10.256C35.5354 9.62667 35.8394 8.87467 35.8394 8C35.8394 7.11467 35.5354 6.368 34.9274 5.76C34.3194 5.14133 33.5727 4.832 32.6874 4.832C31.802 4.832 31.0554 5.14133 30.4474 5.76C29.8394 6.368 29.5354 7.11467 29.5354 8C29.5354 8.87467 29.8394 9.62667 30.4474 10.256ZM42.3473 3.808C43.5419 3.808 44.4966 4.22933 45.2113 5.072C45.9473 5.904 46.3153 6.89067 46.3153 8.032C46.3153 8.08533 46.3046 8.25067 46.2833 8.528H39.2593C39.3659 9.328 39.7073 9.968 40.2833 10.448C40.8593 10.928 41.5793 11.168 42.4433 11.168C43.6593 11.168 44.5179 10.7147 45.0193 9.808L45.9473 10.352C45.5953 10.928 45.1099 11.3813 44.4913 11.712C43.8833 12.032 43.1953 12.192 42.4273 12.192C41.1686 12.192 40.1446 11.7973 39.3553 11.008C38.5659 10.2187 38.1713 9.216 38.1713 8C38.1713 6.79467 38.5606 5.79733 39.3393 5.008C40.1179 4.208 41.1206 3.808 42.3473 3.808ZM42.3473 4.832C41.5153 4.832 40.8166 5.07733 40.2513 5.568C39.6966 6.05867 39.3659 6.704 39.2593 7.504H45.2273C45.1099 6.65067 44.7846 5.99467 44.2513 5.536C43.6966 5.06667 43.0619 4.832 42.3473 4.832ZM54.4025 4V10.976H55.5225V14.144H54.4665V12H47.9385V14.144H46.8825V10.976H47.8585C48.4025 10.2507 48.6745 9.24267 48.6745 7.952V4H54.4025ZM49.1385 10.976H53.3465V5.024H49.7305V7.952C49.7305 9.18933 49.5332 10.1973 49.1385 10.976Z" fill="#0088cc"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M81.2863 2.72984L81.3404 2.67391C81.5747 2.45987 81.9434 2.4434 82.1984 2.62451L82.2596 2.67391L86.8096 6.83015L86.8365 6.85626L86.8724 6.89654L86.919 6.96259L86.9537 7.02952L86.9767 7.09207L86.9955 7.17988L87 7.25L86.9982 7.29467L86.9868 7.36918L86.9677 7.43533L86.9391 7.50129L86.9051 7.55917L86.8572 7.62136L86.8096 7.66984L82.2596 11.8261C82.0058 12.058 81.5942 12.058 81.3404 11.8261C81.1061 11.6121 81.088 11.2753 81.2863 11.0423L81.3404 10.9864L84.7796 7.84375L74.65 7.84375C74.291 7.84375 74 7.57792 74 7.25C74 6.92208 74.291 6.65625 74.65 6.65625L84.7809 6.65625L81.3404 3.51359C81.1061 3.29956 81.088 2.96276 81.2863 2.72984L81.3404 2.67391L81.2863 2.72984Z" fill="#0088cc"></path></svg>
				</div>
			</div>
		</div>
		<?// slice elements height?>
		<?if($arParams['VIEW_TYPE'] == 'table'):?>
			<script type="text/javascript">
			var templateName = '<?=$templateName?>';
			$(document).ready(function(){
				$('.table.' + templateName + ' .row .item:visible .image').sliceHeight({lineheight: -3});
				$('.table.' + templateName + ' .row .item:visible .properties').sliceHeight();
				$('.table.' + templateName + ' .row .item:visible .text').sliceHeight();
			});
			</script>
		<?endif;?>

		<?// bottom pagination?>
		<?if($arParams['DISPLAY_BOTTOM_PAGER']):?>
			<?=$arResult['NAV_STRING']?>
		<?endif;?>
	<?endif;?>
</div>

<script type="text/javascript">
$(document).ready(function(){
	if(window.innerWidth < 1024){
		const swiper = new Swiper('#carousel_staff', {
			loop: true,
			slidesPerView: 1,
			slidesPerColumn: 1,
			slidesPerColumnFill: 'row',
			pagination: { el: '.swiper-pagination' },
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		});
	}
});
</script>

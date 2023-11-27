<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CMain $APPLICATION */
$frame = $this->createFrame()->begin("");
$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);
$injectId = $arParams['UNIQ_COMPONENT_ID'];
if (isset($arResult['REQUEST_ITEMS']))
{
	CJSCore::Init(array('ajax'));
	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedParameters = $signer->sign(
		base64_encode(serialize($arResult['_ORIGINAL_PARAMS'])),
		'bx.bd.products.recommendation'
	);
	$signedTemplate = $signer->sign($arResult['RCM_TEMPLATE'], 'bx.bd.products.recommendation');
	?>
	<span id="<?=$injectId?>"></span>
	<script type="text/javascript">
		BX.ready(function(){
			bx_rcm_get_from_cloud(
				'<?=CUtil::JSEscape($injectId)?>',
				<?=CUtil::PhpToJSObject($arResult['RCM_PARAMS'])?>,
				{
					'parameters':'<?=CUtil::JSEscape($signedParameters)?>',
					'template': '<?=CUtil::JSEscape($signedTemplate)?>',
					'site_id': '<?=CUtil::JSEscape(SITE_ID)?>',
					'rcm': 'yes'
				}
			);
		});
	</script>
	<?
	$frame->end();
	return;
}
// regular template then
// if customized template, for better js performance don't forget to frame content with <span id="{$injectId}_items">...</span> 
if (!empty($arResult['ITEMS'])){ ?>
	<? $sectionName = CIBlockSection::GetByID($arResult['ITEMS']['223']['IBLOCK_SECTION_ID'])->Fetch()['NAME']; ?>
	<span id="<?=$injectId?>_items" class="slider-recom">
		<div class="personal-recommendations swiper">
			<div class="slider-nav">
				<div class="nav-left">
					<img src="/upload/chevron.right.png" alt="right" />
				</div>
				<div class="swiper-pagination swiper-pagination-bullets swiper-pagination-horizontal recommendations"></div>
				<div class="nav-right">
					<img src="/upload/chevron.right.png" alt="right" />
				</div>
			</div>
			<h2>Персональные рекомендации</h2>
			<div class="personal-recommendations-wrapp row swiper-wrapper">
				<? foreach($arResult['ITEMS'] as $key => $item){ ?>
					<!-- item -->
					<div class="item swiper-slide">
						<div class="row-wrapp">
							<div class="img-block">
								<img class="pic" src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $item['NAME'] ?>" />
							</div>
							<div class="content-block">
								<div class="name"><?= $item['NAME'] ?></div>
								<div class="desc"><?= $sectionName ?></div>
								<div class="link">
									<a href="<?= $item['DETAIL_PAGE_URL'] ?>">
										<span>Узнать больше</span>
										<span><img src="/upload/chevron.forward.png" alt="more" /></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				<? } ?>
			</div>
		</div>
	</span>
	<script>
		var perView = 3;
    if($(window).width() <= 1048) perView = 2;
    if($(window).width() <= 650) perView = 1;
    var selector = '.slider-recom';
    var swiper_main = new Swiper(selector + " .swiper", {
        navigation: { 
          nextEl: selector + ' .nav-right', 
          prevEl: selector + ' .nav-left' 
        },
				pagination: {
					el: selector + " .swiper-pagination",
				},
        slidesPerView: perView,
        spaceBetween: 35,
    });
	</script>
<? } ?>
<? $frame->end();
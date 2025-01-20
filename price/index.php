<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Стоимость платных медицинских услуг в клинике микрохирургии «Глаз» им. Святослава Федорова. Мы предлагаем широкий спектр услуг и операций для улучшения и восстановления зрения по лучшим ценам в Екатеринбурге. Звоните: +7 (343) 270-00-30, +7(343)328-88-45");
$APPLICATION->SetPageProperty("title", "Стоимость офтальмологических услуг в Екатеринбурге | Клиника микрохирургии «Глаз» им. Святослава Федорова");
$APPLICATION->SetTitle("Прайс-лист");?><a id="start" ></a> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"catalog-sections_wf", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "catalog-sections_wf",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "27",
		"IBLOCK_TYPE" => "aspro_scorp_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "300",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "PRICE",
			1 => "PRICE_KIDS",
			2 => "anchor",
			3 => "SERVICE_CODE",
			4 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_DETAIL_LINK" => "N",
		"SHOW_GOODS" => "Y",
		"SHOW_SECTIONS" => "Y",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"S_ASK_QUESTION" => "",
		"S_ORDER_PRODUCT" => "",
		"T_CHARACTERISTICS" => "",
		"T_DOCS" => "",
		"T_GALLERY" => "",
		"T_PROJECTS" => "",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?> <br>
 <b>Примечания:</b>
<ul>
	<li>Вы можете оплатить&nbsp;лечение в рассрочку.</li>
	<li>Льготные категории для предоставления скидок на услуги клиники:<br>
	 - Скидка 10% предоставляется инвалидам всех групп,&nbsp;Ветеранам труда.<br>
	 - Скидка 40% на диагностические услуги детям-инвалидам (диагностика зрения, консультации офтальмологов, проверка зрения и подбор очков),<br>
	 - Скидка 20% на остальные услуги клиники предусмотрена для детей-инвалидов (кроме услуг процедурного кабинета).<br>
 <br>
	 ВНИМАНИЕ! Скидки предоставляются при предъявлении документа, подтверждающего право на льготу!<br>
 </li>
	<li>При оказании услуг в срочном порядке, без предварительной записи (при наличии возможности) применяется повышающий коэффициент 2.<br>
 </li>
	<li>При выполнении повторных операций, в случае, если первая операция была выполнена в другой клинике, стоимость операции выше цены прейскуранта на 30% стоимости операции.</li>
</ul>
<p>
	 *Скидки на услуги клиники НЕ ПРЕДОСТАВЛЯЮТСЯ на следующие услуги:&nbsp;&nbsp;услуги процедурного кабинета, лабораторная диагностика, ЭКГ,&nbsp; отдельные консультации специалистов, анестезия, ИОЛ, интравитреальное введение препаратов, инъекции в условиях операционной (введение Кеналога, инъекционное лечение косоглазия), витреоретинальные операции. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
</p>
<p style="text-align: right;">
 <a class="section" href="#start">Вернуться в начало прайс-листа</a>
</p>
<p>
	 Информация на данном интернет-сайте носит исключительно ознакомительный характер и ни при каких условиях не является публичной офертой, определяемой положениями Статьи 437 Гражданского кодекса РФ.
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
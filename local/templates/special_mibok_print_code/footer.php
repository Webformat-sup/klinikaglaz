<?IncludeTemplateLangFile(__FILE__);?>	
<?CModule::IncludeModule("aspro.scorp");?>

<?if($APPLICATION->GetCurDir() == '/'){?>
                  
	<div class="row">
	<div class="col-md-12">
	<?//тизеры?>  
			<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"front-catalog_custom", 
	array(
		"IBLOCK_TYPE" => "aspro_scorp_content",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arCatalogItemsFilter",
		"ORDER_VIEW" => "",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "SHOW_ON_INDEX_PAGE",
			2 => "PRICE",
			3 => "PRICEOLD",
			4 => "STATUS",
			5 => "ARTICLE",
			6 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SHOW_DETAIL_LINK" => "Y",
		"COMPONENT_TEMPLATE" => "front-catalog_custom",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"SHOW_SECTIONS" => "Y",
		"SHOW_GOODS" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y"
	),
	false
);?>
		</div>
		<?//заболевания?>  
		<div class="col-md-12">
			<?$APPLICATION->IncludeComponent("bitrix:news.list", "front-tizer", Array(
	"IBLOCK_TYPE" => "aspro_scorp_content",	// Тип информационного блока (используется только для проверки)
		"IBLOCK_ID" => "2",	// Код информационного блока
		"NEWS_COUNT" => "4",	// Количество новостей на странице
		"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
		"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
		"SORT_BY2" => "ID",	// Поле для второй сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"FILTER_NAME" => "arCatalogItemsFilter",	// Фильтр
		"ORDER_VIEW" => "",
		"FIELD_CODE" => array(	// Поля
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"PROPERTY_CODE" => array(	// Свойства
			0 => "LINK",
			1 => "",
		),
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "3600000",	// Время кеширования (сек.)
		"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"PAGER_TITLE" => "",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SHOW_DETAIL_LINK" => "Y",	// Отображать ссылку на детальную страницу
		"COMPONENT_TEMPLATE" => "front-news_custom",
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"SHOW_SECTIONS" => "Y",
		"SHOW_GOODS" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"SHOW_404" => "N",	// Показ специальной страницы
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y"
	),
	false
);?>
		</div>
		<?//о компании?>
		<div class="col-md-6">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."include/front-about.php",
				"EDIT_TEMPLATE" => "standard.php"
			)
		);?>
		</div>
		<div class="col-md-6">
		<?//новости?>
		<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"front-news_custom", 
	array(
		"IBLOCK_TYPE" => "aspro_scorp_content",
		"IBLOCK_ID" => "16",
		"NEWS_COUNT" => "7",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DATE_ACTIVE_FROM",
			4 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
		"PAGER_SHOW_ALL" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SHOW_DETAIL_LINK" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"COMPONENT_TEMPLATE" => "front-news_custom",
		"SET_LAST_MODIFIED" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
		</div>

	</div>
<?}?>



</div>
                    </div>
                </div>
            </div>      
            
            <footer class="bs-docs-footer" role="contentinfo">
                <div class="container wcag">
                    <div class="panel-group">
                        <button type="button" class="btn btn-default go-top" tabindex="0" aria-label="<?=GetMessage('MIBOK_GO_TOP_BUTTON_TITLE')?>"><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;<?=GetMessage('MIBOK_GO_TOP_BUTTON_TITLE')?><span class="hover"></span></button>
                    </div>    
                    
					<?if(CModule::IncludeModule('advertising')):?>
                                   
					<?endif;?>					
                    <div class="row">
                        <div class="col-md-12" tabindex="0">
                            <div class="address"><strong><?=GetMessage('MIBOK_SITE_ADDRESS')?>:</strong> <?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."glaza_mibok_include/site_address.php", "MIBOK_SPECIAL_COMPARE" => "N"));?></div>
                            <div class="address"><strong><?=GetMessage('MIBOK_SITE_EMAIL')?>:</strong> <?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."glaza_mibok_include/site_email.php", "MIBOK_SPECIAL_COMPARE" => "N"));?></div>
                            <div class="address"><strong><?=GetMessage('MIBOK_SITE_PHONE')?>:</strong> <?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."glaza_mibok_include/site_phone.php", "MIBOK_SPECIAL_COMPARE" => "N"));?></div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-12">
                            <div class="copy"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."glaza_mibok_include/site_copy.php", "MIBOK_SPECIAL_COMPARE" => "N"));?></div>
                        </div>
                    </div>
                </div>                 
            </footer>
        </div>        
		
        <?$APPLICATION->IncludeComponent("mibok:special_check_auth", "", array("MIBOK_SPECIAL_COMPARE" => "N"))?>
        <?=MKSpecial::includesFilesFooter(SITE_TEMPLATE_PATH)?>
		
    </body>
</html>

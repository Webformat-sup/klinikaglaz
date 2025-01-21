<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии по подписке");?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_RECURSIVE" => "Y",
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "inc",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_TEMPLATE" => "include_area.php",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

<br>

 <div class="col-md-12">
		<div class="order-block">
			<div class="row">
				
				<div class="col-md-8 col-sm-8 col-xs-7 valign" style="height: 83px;">
					<div class="text" style="padding-top: 22px; padding-bottom: 22px; height: 83px;">Если у вас нет готового резюме,<br> вы можете скачать и заполнить наш бланк анкеты</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-5 valign" style="padding-top: 22px; padding-bottom: 22px; height: 83px;">
					<a class="btn btn-default btn-lg wc" href="Anketa.doc" download="Анкета.doc" ><i class="fa fa-download "></i> <span>Скачать бланк</span></a>
				</div>
			</div>
		</div>
	</div>
	
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_RECURSIVE" => "Y",
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "after",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_TEMPLATE" => "include_area.php",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
 <br><br><br>

<?$APPLICATION->IncludeComponent("bitrix:news", "vacancy-subscr", Array(
	"ADD_ELEMENT_CHAIN" => "N",	// Включать название элемента в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"CACHE_TIME" => "100000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"COMPONENT_TEMPLATE" => "vacancy",
		"COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
		"COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DETAIL_DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DETAIL_FIELD_CODE" => array(	// Поля
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
		"DETAIL_PAGER_TEMPLATE" => "",	// Название шаблона
		"DETAIL_PAGER_TITLE" => "Страница",	// Название категорий
		"DETAIL_PROPERTY_CODE" => array(	// Свойства
			0 => "PAY",
			1 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "Y",	// Устанавливать канонический URL
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_NAME" => "N",	// Выводить название элемента
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "78",	// Инфоблок
		"IBLOCK_TYPE" => "aspro_scorp_content",	// Тип инфоблока
		"IMAGE_POSITION" => "right",	// Положение картинки анонса
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"LIST_FIELD_CODE" => array(	// Поля
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"LIST_PROPERTY_CODE" => array(	// Свойства
			0 => "PAY",
			1 => "",
		),
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"NEWS_COUNT" => "20",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"SEF_FOLDER" => "/sale/vakansii-po-podpiske/",	// Каталог ЧПУ (относительно корня сайта)
		"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_STATUS_404" => "Y",	// Устанавливать статус 404
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SHOW_DETAIL_LINK" => "Y",	// Отображать ссылку на детальную страницу
		"SHOW_SECTION_PREVIEW_DESCRIPTION" => "Y",	// Выводить краткое описание раздела
		"SHOW_TABS" => "N",	// Показывать табы
		"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
		"SORT_BY2" => "ID",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "DESC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела
		"USE_CATEGORIES" => "N",	// Выводить материалы по теме
		"USE_FILTER" => "N",	// Показывать фильтр
		"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
		"USE_RATING" => "N",	// Разрешить голосование
		"USE_REVIEW" => "N",	// Разрешить отзывы
		"USE_RSS" => "N",	// Разрешить RSS
		"USE_SEARCH" => "N",	// Разрешить поиск
		"VIEW_TYPE" => "accordion",	// Вид отображения
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
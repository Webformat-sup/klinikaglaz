<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "Контакты компании");
$APPLICATION->SetPageProperty("keywords", "Контакты компании");
$APPLICATION->SetPageProperty("description", "Контакты компании");
$APPLICATION->SetPageProperty("title", "Контакты компании");
$APPLICATION->SetTitle("Контакты компании");?><div class="row contacts" itemtype="http://schema.org/Organization" itemscope="">
	<div class="col-md-12">
		<h4><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-name.php", Array(), Array("MODE" => "html", "NAME" => "Name"));?></h4>
	</div>
 <br>
	<div class="col-md-4">
		<div itemprop="description">
			 <?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-about.php", Array(), Array("MODE" => "html", "NAME" => "Contacts about"));?>
		</div>
 <br>
 <br>
		<table cellpadding="0" cellspasing="0">
		<tbody>
		<tr>
			<td align="left" valign="top">
 <i class="fa colored fa-map-marker"></i>
			</td>
			<td align="left" valign="top">
 <span class="dark_table">Адрес</span> <br>
 <span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-address.php", Array(), Array("MODE" => "html", "NAME" => "Address"));?></span>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
 <i class="fa colored fa-phone"></i>
			</td>
			<td align="left" valign="top">
 <span class="dark_table">Телефон</span> <br>
 <span itemprop="telephone"><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-phone.php", Array(), Array("MODE" => "html", "NAME" => "Phone"));?></span>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
 <i class="fa colored fa-envelope"></i>
			</td>
			<td align="left" valign="top">
 <span class="dark_table">E-mail</span> <br>
 <span itemprop="email"><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-email.php", Array(), Array("MODE" => "html", "NAME" => "Email"));?></span>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
 <i class="fa colored fa-clock-o"></i>
			</td>
			<td align="left" valign="top">
 <span class="dark_table">Режим работы</span> <br>
				 <?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-schedule.php", Array(), Array("MODE" => "html", "NAME" => "Schedule"));?>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	<div class="col-md-8">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONTROLS" => array(0=>"ZOOM",),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:56.84801629966556;s:10:\"yandex_lon\";d:60.597828581082005;s:12:\"yandex_scale\";i:15;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:60.597828581082;s:3:\"LAT\";d:56.848016299673;s:4:\"TEXT\";s:127:\"улица Николая Никонова, 18, Екатеринбург, Свердловская область, Россия\";}}}",
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "Екатеринбург, Николая Никонова,18",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(0=>"ENABLE_DBLCLICK_ZOOM",)
	)
);?>
		<h3>Реквизиты компании</h3>
		<p>
			 Ниже приведены реквизиты компании, в случае необходимости получения дополнительных документов: свидетельства о государственной регистрации, идентификационного номера налогоплательщика вы можете обратиться в бухгалтерию предприятия.&nbsp;
		</p>
		 <?/*	<tr>
			<td>
 <b>Юридический адрес:</b>
			</td>
			<td>
				 620137, Свердловская обл., г. Екатеринбург, ул. Июльская, д. 25, кв. 111
			</td>
		</tr>*/?>
		<table class="table table-striped">
		<tbody>
		<tr>
			<td>
 <b>Полное наименование:</b>
			</td>
			<td>
				 ООО «Клиника Микрохирургии «Глаз» им. Академика С.Н. Федорова»
			</td>
		</tr>
		<tr>
			<td>
 <b>Сокращенное наименование:</b>
			</td>
			<td>
				 &nbsp; ООО «КМ «Глаз» им. Академика С.Н. Федорова»
			</td>
		</tr>
		<tr>
			<td>
 <b>ИНН/КПП:</b>
			</td>
			<td>
				 &nbsp;6670422810/667001001
			</td>
		</tr>
		<tr>
			<td>
 <b>ОРГН:</b>
			</td>
			<td>
				 1146670009540
			</td>
		</tr>
		<tr>
			<td>
 <b>Фактический адрес:</b>
			</td>
			<td>
				 620027, Свердловская обл., г. Екатеринбург, ул. Никонова, д. 18
			</td>
		</tr>
		<tr>
			<td>
 <b>Телефон, факс:</b>
			</td>
			<td>
				 +7 (343) 270-00-30
			</td>
		</tr>
		<tr>
			<td>
 <b>Электронная почта:</b>
			</td>
			<td>
				 &nbsp;
			</td>
		</tr>
		<tr>
			<td>
 <b>Сайт:</b>
			</td>
			<td>
 <a href="http://klinikaglaz.ru">http://klinikaglaz.ru</a>
			</td>
		</tr>
		<tr>
			<td>
 <b>Банковские реквизиты:</b>
			</td>
			<td>
				 БИК 046577545 <br>
				 Р/с №40702810200630040137 в Филиале "Уральский" Банка ВТБ (ПАО) <br>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
</div>
		<?// class=col-md-12 col-sm-12 col-xs-12 content-md?>
	<?// class="maxwidth-theme?>
<?// class=row?>
<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("contacts-form-block");?>
<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("contacts-form-block", "");?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
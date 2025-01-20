<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<div class="social-icons">
	<!-- noindex -->
	<ul>
		<?if(!empty($arResult['SOCIAL_VK'])):?>
			<li class="vk">
				<a href="<?=$arResult['SOCIAL_VK']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_VK')?>">
					<img src="/local/templates/aspro-scorp_wf/images/soc_seti_Vk.png" alt="<?=GetMessage('TEMPL_SOCIAL_VK')?>" title="<?=GetMessage('TEMPL_SOCIAL_VK')?>">
					<?=GetMessage('TEMPL_SOCIAL_VK')?>
					<i class="fa fa-vk"></i>
					<i class="fa fa-vk hide"></i>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_FACEBOOK'])):?>
			<li class="facebook">
				<a href="<?=$arResult['SOCIAL_FACEBOOK']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_FACEBOOK')?>">
					<img src="/local/templates/aspro-scorp_wf/images/soc_seti_fb.png" alt="<?=GetMessage('TEMPL_SOCIAL_FACEBOOK')?>" title="<?=GetMessage('TEMPL_SOCIAL_FACEBOOK')?>">
					<?=GetMessage('TEMPL_SOCIAL_FACEBOOK')?>
					<i class="fa fa-facebook"></i>
					<i class="fa fa-facebook hide"></i>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_INSTAGRAM'])):?>
			<li class="instagram">
				<a href="<?=$arResult['SOCIAL_INSTAGRAM']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_INSTAGRAM')?>">
					<img src="/local/templates/aspro-scorp_wf/images/instagram_PNG9.png" alt="<?=GetMessage('TEMPL_SOCIAL_INSTAGRAM')?>" title="<?=GetMessage('TEMPL_SOCIAL_INSTAGRAM')?>">
					<?=GetMessage('TEMPL_SOCIAL_INSTAGRAM')?>
					<i class="fa fa-instagram"></i>
					<i class="fa fa-instagram hide"></i>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_YOUTUBE'])):?>
			<li class="lj">
				<a href="<?=$arResult['SOCIAL_YOUTUBE']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_YOUTUBE')?>">
					<img src="/local/templates/aspro-scorp_wf/images/soc_seti_YT.png" alt="<?=GetMessage('TEMPL_SOCIAL_YOUTUBE')?>" title="<?=GetMessage('TEMPL_SOCIAL_YOUTUBE')?>">
					<?=GetMessage('TEMPL_SOCIAL_YOUTUBE')?>
					<i class="fa fa-youtube"></i>
					<i class="fa fa-youtube hide"></i>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_ODNOKLASSNIKI'])):?>
			<li class="lj">
				<a href="<?=$arResult['SOCIAL_ODNOKLASSNIKI']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_ODNOKLASSNIKI')?>">
					<img src="/local/templates/aspro-scorp_wf/images/soc_seti_odn.png" alt="<?=GetMessage('TEMPL_SOCIAL_ODNOKLASSNIKI')?>" title="<?=GetMessage('TEMPL_SOCIAL_ODNOKLASSNIKI')?>">
					<?=GetMessage('TEMPL_SOCIAL_ODNOKLASSNIKI')?>
					<i class="fa fa-odnoklassniki"></i>
					<i class="fa fa-odnoklassniki hide"></i>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_TWITTER'])):?>
			<li class="twitter">
				<a href="<?=$arResult['SOCIAL_TWITTER']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_TWITTER')?>">

					<?=GetMessage('TEMPL_SOCIAL_TWITTER')?>
					<i class="fa fa-twitter"></i>
					<i class="fa fa-twitter hide"></i>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_GOOGLEPLUS'])):?>
			<li class="lj">
				<a href="<?=$arResult['SOCIAL_GOOGLEPLUS']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_GOOGLEPLUS')?>">
					<?=GetMessage('TEMPL_SOCIAL_GOOGLEPLUS')?>
					<i class="fa fa-google-plus"></i>
					<i class="fa fa-google-plus hide"></i>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arParams['SOCIAL_ZEN_LINK'])):?>
			<li class="zen">
				<a href="<?= $arParams['SOCIAL_ZEN_LINK'] ?>" target="_blank" rel="nofollow" title="zen" style="border-radius: 0;">
					<svg width="28" height="28" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M39.9883 20.3586C39.9883 20.3679 39.9977 20.452 39.9977 20.5454C39.9883 24.0308 40.0351 27.5162 39.9696 31.0016C39.9229 33.7394 38.9792 36.1409 36.8113 37.9349C35.1948 39.2805 33.2699 39.8785 31.2142 39.9159C27.6073 39.9813 23.9911 39.9533 20.3843 39.9626C20.3563 39.9626 20.3282 39.9439 20.3376 39.9439C20.3376 38.9254 20.2908 37.9162 20.3469 36.9164C20.4497 35.0289 20.5712 33.132 20.7674 31.2445C21.0103 28.9365 21.5803 26.7219 23.0287 24.8251C24.6826 22.6479 26.9439 21.4238 29.5883 21.022C31.8122 20.6763 34.0641 20.5174 36.3067 20.3586C37.5028 20.2838 38.7175 20.3586 39.9883 20.3586Z" fill="#242632"/>
						<path d="M19.6461 39.9813C17.8427 39.9813 16.0206 39.9906 14.1984 39.9813C12.2362 39.972 10.2739 40.0093 8.32096 39.8879C4.19084 39.6356 1.2194 36.9912 0.369083 33.3283C0.163511 32.4312 0.0513815 31.4875 0.0420374 30.5717C0.00466073 27.2265 0.0233486 23.872 0.0233486 20.5268C0.0233486 20.452 0.0326932 20.3773 0.0420374 20.2838C0.668096 20.2838 1.28481 20.2464 1.89218 20.2932C4.4151 20.4614 6.94737 20.5828 9.46095 20.8631C11.7316 21.1154 13.8527 21.863 15.6188 23.3954C17.5343 25.0587 18.5248 27.2265 18.992 29.6747C19.4405 32.0481 19.5713 34.4589 19.6461 36.8604C19.6741 37.8789 19.6461 38.9067 19.6461 39.9813Z" fill="#242632"/>
						<path d="M39.9883 19.611C38.6895 19.611 37.428 19.6484 36.1759 19.6017C33.8492 19.5083 31.5225 19.3774 29.2332 18.8822C27.4298 18.4897 25.7758 17.7796 24.3742 16.5555C22.7857 15.1726 21.7392 13.4345 21.3093 11.3975C20.9356 9.62213 20.702 7.81871 20.5431 6.00594C20.3656 4.02498 20.3375 2.03467 20.2441 0.00698697C20.4497 0.00698697 20.5992 0.00698697 20.7487 0.00698697C23.9911 0.00698697 27.2242 -0.0117008 30.4666 0.0163317C32.6251 0.03502 34.6995 0.446163 36.4843 1.79172C38.6521 3.42695 39.8295 5.64152 39.9136 8.32329C40.0257 12.0516 39.9883 15.7893 40.0163 19.5269C39.9977 19.5643 39.9883 19.6017 39.9883 19.611Z" fill="#242632"/>
						<path d="M19.7491 0.00694821C19.693 1.51136 19.693 2.94101 19.5809 4.36133C19.422 6.36098 19.2632 8.36063 18.9641 10.3322C18.6184 12.6122 17.656 14.6306 15.9647 16.2471C14.3855 17.7609 12.4606 18.5551 10.3395 18.9662C7.96606 19.4241 5.56461 19.5456 3.15382 19.6203C2.13531 19.6484 1.10745 19.6297 0.0515585 19.6297C0.0515585 19.6203 0.0235257 19.5456 0.0235257 19.4802C0.0328699 15.9481 0.0141817 12.416 0.0609025 8.8839C0.088935 6.96835 0.584175 5.16492 1.74285 3.60445C3.28464 1.53005 5.37773 0.408747 7.92869 0.147111C8.66687 0.0723573 9.41441 0.0256371 10.1619 0.0162929C13.1521 -0.00239538 16.1422 0.00694821 19.123 0.00694821C19.3099 0.00694821 19.4968 0.00694821 19.7491 0.00694821Z" fill="#242632"/>
					</svg>
				</a>
			</li>
		<?endif;?>
	</ul>
	<!-- /noindex -->
</div>
<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\Page\Asset;

if ($arParams['GUEST_MODE'] !== 'Y') {
    Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/script.js");
    //Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/style.css");
}
CJSCore::Init(array('clipboard', 'fx'));

$APPLICATION->SetTitle("");

if (!empty($arResult['ERRORS']['FATAL'])) {
    $component = $this->__component;
    foreach ($arResult['ERRORS']['FATAL'] as $code => $error) {
        if ($code !== $component::E_NOT_AUTHORIZED) {
            ShowError($error);
        }
    }

    if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED])) {
        ?>
		<div class="row">
			<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
				<div class="alert alert-danger"><?= $arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED] ?></div>
			</div>
            <? $authListGetParams = array(); ?>
			<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <?
                $APPLICATION->AuthForm('', false, false, 'N', false); ?>
			</div>
		</div>
        <?
    }
} else {
    if (!empty($arResult['ERRORS']['NONFATAL'])) {
        foreach ($arResult['ERRORS']['NONFATAL'] as $error) {
            ShowError($error);
        }
    }
    ?>

	<h6>
        <?= Loc::getMessage('SPOD_LIST_MY_ORDER', array(
            '#ACCOUNT_NUMBER#' => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"]),
            '#DATE_ORDER_CREATE#' => $arResult["DATE_INSERT_FORMATED"]
        )) ?>
		<span>
			<?= count($arResult['BASKET']); ?>
            <?
            $count = count($arResult['BASKET']) % 10;
            if ($count == '1') {
                echo Loc::getMessage('SPOD_TPL_GOOD');
            } elseif ($count >= '2' && $count <= '4') {
                echo Loc::getMessage('SPOD_TPL_TWO_GOODS');
            } else {
                echo Loc::getMessage('SPOD_TPL_GOODS');
            }
            ?>
            <?= Loc::getMessage('SPOD_TPL_SUMOF') ?>
            <?= $arResult["PRICE_FORMATED"] ?>
		</span>
	</h6>
	<div class="orders order">
		<div class="order__item">
			<div class="orders__subblock">
				<div class="orders__subtitle">
					Информация о заказе
				</div>
			</div>
			<div class="order-scroll js-order-scroll">
				<div class="order__wrap">
					<div class="order__table">
						<table>
							<thead>
							<tr>
								<th>

								</th>
								<th>
									Статус
								</th>
								<th>
									Сумма
								</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>
                                    <?
                                    $userName = $arResult["USER_NAME"];
                                    ?>
                                    <? if ($userName <> '') {
                                        echo htmlspecialcharsbx($userName);
                                    } elseif (mb_strlen($arResult['FIO'])) {
                                        echo htmlspecialcharsbx($arResult['FIO']);
                                    } else {
                                        echo htmlspecialcharsbx($arResult["USER"]['LOGIN']);
                                    }
                                    ?>
								</td>
								<td class="text-green">
                                    <? if ($arResult['CANCELED'] !== 'Y') {
                                        echo htmlspecialcharsbx($arResult["STATUS"]["NAME"]);
                                    } else {
                                        echo Loc::getMessage('SPOD_ORDER_CANCELED');
                                    }
                                    ?>
								</td>
								<td>
                                    <?= $arResult["PRICE_FORMATED"] ?>
								</td>
							</tr>
							</tbody>
						</table>
						<div class="row m-0 sale-order-detail-more-info-details" style="display: none;">
							<div class="col">
								<h4 class="sale-order-detail-more-info-details-title"><?= Loc::getMessage('SPOD_USER_INFORMATION') ?></h4>

								<div class="table-responsive">
									<table class="table table-bordered table-striped mb-3 sale-order-detail-more-info-details-table">
                                        <? if (mb_strlen($arResult["USER"]["LOGIN"]) && !in_array("LOGIN",
                                                $arParams['HIDE_USER_INFO'])) {
                                            ?>
											<tr>
												<th><?= Loc::getMessage('SPOD_LOGIN') ?>:</th>
												<td><?= htmlspecialcharsbx($arResult["USER"]["LOGIN"]) ?></td>
											</tr>
                                            <?
                                        }
                                        if (mb_strlen($arResult["USER"]["EMAIL"]) && !in_array("EMAIL",
                                                $arParams['HIDE_USER_INFO'])) {
                                            ?>
											<tr>
												<th><?= Loc::getMessage('SPOD_EMAIL') ?>:</th>
												<td>
													<a class=""
													   href="mailto:<?= htmlspecialcharsbx($arResult["USER"]["EMAIL"]) ?>"><?= htmlspecialcharsbx($arResult["USER"]["EMAIL"]) ?></a>
												</td>
											</tr>
                                            <?
                                        }
                                        if (mb_strlen($arResult["USER"]["PERSON_TYPE_NAME"]) && !in_array("PERSON_TYPE_NAME",
                                                $arParams['HIDE_USER_INFO'])) {
                                            ?>
											<tr>
												<th><?= Loc::getMessage('SPOD_PERSON_TYPE_NAME') ?>:</th>
												<td><?= htmlspecialcharsbx($arResult["USER"]["PERSON_TYPE_NAME"]) ?></td>
											</tr>
                                            <?
                                        }
                                        if (isset($arResult["ORDER_PROPS"])) {
                                            foreach ($arResult["ORDER_PROPS"] as $property) {
                                                ?>
												<tr>
													<th><?= htmlspecialcharsbx($property['NAME']) ?>:</th>
													<td><? if ($property["TYPE"] == "Y/N") {
                                                            echo Loc::getMessage('SPOD_' . ($property["VALUE"] == "Y" ? 'YES' : 'NO'));
                                                        } else {
                                                            if ($property['MULTIPLE'] == 'Y'
                                                                && $property['TYPE'] !== 'FILE'
                                                                && $property['TYPE'] !== 'LOCATION') {
                                                                $propertyList = unserialize($property["VALUE"],
                                                                    ['allowed_classes' => false]);
                                                                foreach ($propertyList as $propertyElement) {
                                                                    echo $propertyElement . '</br>';
                                                                }
                                                            } elseif ($property['TYPE'] == 'FILE') {
                                                                echo $property["VALUE"];
                                                            } else {
                                                                echo htmlspecialcharsbx($property["VALUE"]);
                                                            }
                                                        }
                                                        ?>
													</td>
												</tr>
                                                <?
                                            }
                                        }
                                        ?>
									</table>
								</div>
							</div>
						</div>
					</div>

                    <? if ($arParams['GUEST_MODE'] !== 'Y') { ?>
						<a href="<?= $arResult["URL_TO_COPY"] ?>" class="btn btn-secondary">
                            <?= Loc::getMessage('SPOD_ORDER_REPEAT') ?>
						</a>
                        <? /* if ($arResult["CAN_CANCEL"] === "Y") {
                            ?>
							<a href="<?= $arResult["URL_TO_CANCEL"] ?>"
							   class="btn btn-link btn-sm my-1"><?= Loc::getMessage('SPOD_ORDER_CANCEL') ?></a>
                            <?
                        }*/ ?>
                    <? } ?>
				</div>
			</div>
			<div class="order__more">
				<a href="" onclick="return false;"
				   class="order__more sale-order-detail-more-info-less"><?= Loc::getMessage('SPOD_LIST_LESS') ?></a>
				<a href="" onclick="return false;"
				   class="order__more sale-order-detail-more-info-more"><?= Loc::getMessage('SPOD_LIST_MORE') ?></a>

			</div>
		</div>
		<div class="order__item">
			<div class="orders__subblock">
				<div class="orders__subtitle">
					Параметры оплаты
				</div>
			</div>
			<div class="order-scroll js-order-scroll">
				<table>
					<thead>
					<tr>
						<th>

						</th>
						<th>
							Номер счета
						</th>
						<th>
							Статус оплаты
						</th>
						<th>
							Описание
						</th>
						<th>
							Сумма
						</th>
					</tr>
					</thead>
					<tbody>
                    <? foreach ($arResult['PAYMENT'] as $payment) {
                        $paymentData[$payment['ACCOUNT_NUMBER']] = array(
                            "payment" => $payment['ACCOUNT_NUMBER'],
                            "order" => $arResult['ACCOUNT_NUMBER'],
                            "allow_inner" => $arParams['ALLOW_INNER'],
                            "only_inner_full" => $arParams['ONLY_INNER_FULL'],
                            "refresh_prices" => $arParams['REFRESH_PRICES'],
                            "path_to_payment" => $arParams['PATH_TO_PAYMENT']
                        );
                        $paymentSubTitle = Loc::getMessage('SPOD_TPL_BILL') . " " . Loc::getMessage('SPOD_NUM_SIGN') . $payment['ACCOUNT_NUMBER'];
                        if (isset($payment['DATE_BILL'])) {
                            $paymentSubTitle .= " " . Loc::getMessage('SPOD_FROM') . " " . $payment['DATE_BILL_FORMATED'];
                        }
                        $paymentSubTitle .= ","; ?>
						<tr>
							<td>
                                <?= $payment['PAY_SYSTEM_NAME'] ?>
							</td>
							<td>
								<b>
                                    <?= $paymentSubTitle ?>
								</b>
							</td>
							<td class="text-green">
                                <? if ($payment['PAID'] === 'Y') { ?>
                                    <?= Loc::getMessage('SPOD_PAYMENT_PAID') ?>
                                <? } elseif ($arResult['IS_ALLOW_PAY'] == 'N') { ?>
                                    <?= Loc::getMessage('SPOD_TPL_RESTRICTED_PAID') ?>
                                <? } else { ?>
                                    <?= Loc::getMessage('SPOD_PAYMENT_UNPAID') ?>
                                <? } ?>
							</td>
							<td class="">
                                <?= $payment['PS_STATUS_DESCRIPTION']; ?>
							</td>
							<td>
                                <?= $payment['PRICE_FORMATED'] ?>
							</td>
						</tr>
                        <?
                    } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="order__item">
			<div class="orders__subblock">
				<div class="orders__subtitle">
					Параметры отгрузки
				</div>
			</div>
			<div class="order-scroll js-order-scroll">
				<table>
					<thead>
					<tr>
						<th>
							Номер отгрузки
						</th>
						<th>
							Статус отгрузки
						</th>
						<th>
							Статус оплаты
						</th>
						<th>
							Стоимость доставки
						</th>
						<th>
					</tr>
					</thead>
					<tbody>
                    <? foreach ($arResult['SHIPMENT'] as $shipment) { ?>
						<tr class="sale-order-detail-payment-options-shipment">
							<td>
								<b>
                                    <?
                                    //change date
                                    if ($shipment['PRICE_DELIVERY_FORMATED'] == '') {
                                        $shipment['PRICE_DELIVERY_FORMATED'] = 0;
                                    }
                                    $shipmentRow = Loc::getMessage('SPOD_SUB_ORDER_SHIPMENT') . " " . Loc::getMessage('SPOD_NUM_SIGN') . $shipment["ACCOUNT_NUMBER"];
                                    if ($shipment["DATE_DEDUCTED"]) {
                                        $shipmentRow .= " " . Loc::getMessage('SPOD_FROM') . " " . $shipment["DATE_DEDUCTED_FORMATED"];
                                    }
                                    $shipmentRow = htmlspecialcharsbx($shipmentRow);
                                    /*$shipmentRow .= ", " . Loc::getMessage('SPOD_SUB_PRICE_DELIVERY',
                                            array(
                                                '#PRICE_DELIVERY#' => $shipment['PRICE_DELIVERY_FORMATED']
                                            ));*/
                                    echo $shipmentRow;
                                    ?>
								</b>
								<div class="order__more sale-order-detail-payment-options-methods-shipment-list-item-link">
									<a href="" onclick="return false"
									   class="sale-order-detail-show-link"><?= Loc::getMessage('SPOD_LIST_SHOW_ALL') ?></a>
									<a href="" onclick="return false"
									   class="sale-order-detail-hide-link"><?= Loc::getMessage('SPOD_LIST_LESS') ?></a>
								</div>
							</td>
							<td class="text-red">
                                <?= htmlspecialcharsbx($shipment['STATUS_NAME']) ?>
							</td>
							<td class="">
								<b>
                                    <?= htmlspecialcharsbx($shipment["DELIVERY_NAME"]) ?>
								</b>
							</td>
							<td class="">
                                <?= $shipment['PRICE_DELIVERY_FORMATED']; ?>
							</td>
							<td class="sale-order-detail-payment-options-shipment-composition-map"
							    style="display: none;">
                                <? if ($shipment['TRACKING_NUMBER'] <> '') {
                                    ?>
									<div
											class="mb-2 sale-order-detail-payment-options-methods-shipment-list-item">
															<span
																	class="sale-order-list-shipment-id-name"><?= Loc::getMessage('SPOD_ORDER_TRACKING_NUMBER') ?>:</span>
										<span
												class="sale-order-detail-shipment-id"><?= htmlspecialcharsbx($shipment['TRACKING_NUMBER']) ?></span>
										<span class="sale-order-detail-shipment-id-icon"></span>
									</div>
                                    <?
                                } ?>
                                <? if ($shipment['TRACKING_URL'] <> '') {
                                    ?>
									<div
											class="mb-2 sale-order-detail-payment-options-shipment-button-container">
										<a href="" onclick="return false"
										   class="sale-order-detail-payment-options-shipment-button-element"
										   href="<?= $shipment['TRACKING_URL'] ?>"><?= Loc::getMessage('SPOD_ORDER_CHECK_TRACKING') ?></a>
									</div>
                                    <?
                                } ?>
								<div class="row">
									<div class="col">
                                        <? $store = $arResult['DELIVERY']['STORE_LIST'][$shipment['STORE_ID']];
                                        if (isset($store)) {
                                            ?>
											<div class="row mx-0 mb-3">
												<div class="col sale-order-detail-map-container">
													<h4 class="sale-order-detail-more-info-details-title"><?= Loc::getMessage('SPOD_SHIPMENT_STORE') ?></h4>
                                                    <? $APPLICATION->IncludeComponent("bitrix:map.yandex.view",
                                                        "", Array(
                                                            "INIT_MAP_TYPE" => "COORDINATES",
                                                            "MAP_DATA" => serialize(
                                                                array(
                                                                    'yandex_lon' => $store['GPS_S'],
                                                                    'yandex_lat' => $store['GPS_N'],
                                                                    'PLACEMARKS' => array(
                                                                        array(
                                                                            "LON" => $store['GPS_S'],
                                                                            "LAT" => $store['GPS_N'],
                                                                            "TEXT" => htmlspecialcharsbx($store['TITLE'])
                                                                        )
                                                                    )
                                                                )
                                                            ),
                                                            "MAP_WIDTH" => "100%",
                                                            "MAP_HEIGHT" => "300",
                                                            "CONTROLS" => array(
                                                                "ZOOM",
                                                                "SMALLZOOM",
                                                                "SCALELINE"
                                                            ),
                                                            "OPTIONS" => array(
                                                                "ENABLE_DRAGGING",
                                                                "ENABLE_SCROLL_ZOOM",
                                                                "ENABLE_DBLCLICK_ZOOM"
                                                            ),
                                                            "MAP_ID" => ""
                                                        )
                                                    );
                                                    ?>
												</div>
											</div>

                                            <? if ($store['ADDRESS'] <> '') {
                                                ?>
												<div class="row">
													<div
															class="col sale-order-detail-payment-options-shipment-map-address">
														<div class="row">
																		<span
																				class="col-md-2 sale-order-detail-payment-options-shipment-map-address-title">
																			<?= Loc::getMessage('SPOD_STORE_ADDRESS') ?>:
																		</span>
															<span
																	class="col sale-order-detail-payment-options-shipment-map-address-element"> <?= htmlspecialcharsbx($store['ADDRESS']) ?> </span>
														</div>
													</div>
												</div>
                                                <?
                                            }
                                        }
                                        ?>

										<div class="row mx-0 mb-3">
											<div class="col">
												<h3 class="sale-order-detail-more-info-details-title"><?= Loc::getMessage('SPOD_ORDER_SHIPMENT_BASKET') ?></h3>
												<div class="table-responsive">
													<table class="table">
														<tbody>
                                                        <? foreach ($shipment['ITEMS'] as $item) {
                                                            $basketItem = $arResult['BASKET'][$item['BASKET_ID']];
                                                            ?>
															<tr>
																<td class="sale-order-detail-order-item-img-block">
																	<a href="<?= htmlspecialcharsbx($basketItem['DETAIL_PAGE_URL']) ?>">
                                                                        <? if ($basketItem['PICTURE']['SRC'] <> '') {
                                                                            $imageSrc = htmlspecialcharsbx($basketItem['PICTURE']['SRC']);
                                                                        } else {
                                                                            $imageSrc = $this->GetFolder() . '/images/no_photo.png';
                                                                        }
                                                                        ?>
																		<span class="sale-order-detail-order-item-img-container"
																		      style="background-image: url(<?= $imageSrc ?>);"></span>
																	</a>
																</td>
																<td class="sale-order-detail-order-item-properties"
																    style="min-width: 250px;">
																	<a class="sale-order-detail-order-item-title"
																	   href="<?= htmlspecialcharsbx($basketItem['DETAIL_PAGE_URL']) ?>">
                                                                        <?= htmlspecialcharsbx($basketItem['NAME']) ?>
																	</a>
                                                                    <? if (isset($basketItem['PROPS']) && is_array($basketItem['PROPS'])) {
                                                                        foreach ($basketItem['PROPS'] as $itemProps) {
                                                                            ?>
																			<div>
                                                                                <?= htmlspecialcharsbx($itemProps['NAME']) ?>
																				:
                                                                                <?= htmlspecialcharsbx($itemProps['VALUE']) ?>
																			</div>
                                                                            <?
                                                                        }
                                                                    }
                                                                    ?>
																</td>
																<td class="sale-order-detail-order-item-properties">
                                                                    <?= Loc::getMessage('SPOD_QUANTITY') ?>:
                                                                    <?= $item['QUANTITY'] ?>
																	&nbsp;<?= htmlspecialcharsbx($item['MEASURE_NAME']) ?>
																</td>
															</tr>
                                                            <?
                                                        }
                                                        ?>
														</tbody>
													</table>
												</div>

											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
                    <? } ?>
					</tbody>
				</table>
			</div>
            <?/*
			<div class="order__more">
				<a href="#">
					Показать все
				</a>
			</div>*/ ?>
		</div>
		<div class="basket-table">
			<table>
				<thead>
				<tr>
					<th>

					</th>
					<th>
						ЦЕНА
					</th>
					<th>
						КОЛИЧЕСТВО
					</th>
					<th>
						СУММА
					</th>
				</tr>
				</thead>
				<tbody>
                <? foreach ($arResult['BASKET'] as $basketItem) { ?>
					<tr>
						<td>
							<a href="<?= $basketItem['DETAIL_PAGE_URL'] ?>" class="basket-table__info">
                                <?
                                if ($basketItem['PICTURE']['SRC'] <> '') {
                                    $imageSrc = $basketItem['PICTURE']['SRC'];
                                } else {
                                    $imageSrc = $this->GetFolder() . '/images/no_photo.png';
                                }
                                ?>
								<span class="basket-table__icon">
                                    <img src="<?= $imageSrc ?>"
                                         alt="<?= htmlspecialcharsbx($basketItem['NAME']) ?>"
                                         title="<?= htmlspecialcharsbx($basketItem['NAME']) ?>"
                                         loading="lazy">
                                </span>
								<span class="basket-table__text">
                                    <?= htmlspecialcharsbx($basketItem['NAME']) ?>
                                </span>
							</a>
						</td>
						<td data-text="Стоимость">
							<b><?= $basketItem['PRICE_FORMATED'] ?></b>
                            <? if ($basketItem["DISCOUNT_PRICE"] > 0) { ?>
								<span class="text-discount">
									 <?= $basketItem['BASE_PRICE_FORMATED']; ?>
                                </span>
                            <? } ?>
						</td>
						<td data-text="Количество">
                            <?= $basketItem['QUANTITY'] ?>&nbsp;
                            <?
                            if ($basketItem['MEASURE_NAME'] <> '') {
                                echo htmlspecialcharsbx($basketItem['MEASURE_NAME']);
                            } else {
                                echo Loc::getMessage('SPOD_DEFAULT_MEASURE');
                            }
                            ?>
						</td>
						<td data-text="Итоговая стоимость">
							<b>
                                <?= $basketItem['FORMATED_SUM'] ?>
							</b>
						</td>
					</tr>
                    <?
                }
                ?>
				</tbody>
			</table>
			<div class="basket-table__total">
				Итого: <?= $arResult['PRICE_FORMATED'] ?>
			</div>
			<a href="<?= $arResult["URL_TO_LIST"] ?>" class="btn btn-secondary">
				Вернуться в список заказов
			</a>
		</div>
	</div>


    <?
    $javascriptParams = array(
        "url" => CUtil::JSEscape($this->__component->GetPath() . '/ajax.php'),
        "templateFolder" => CUtil::JSEscape($templateFolder),
        "templateName" => $this->__component->GetTemplateName(),
        "paymentList" => $paymentData,
        "returnUrl" => $arResult['RETURN_URL'],
    );
    $javascriptParams = CUtil::PhpToJSObject($javascriptParams);
    ?>
	<script>
        BX.Sale.PersonalOrderComponent.PersonalOrderDetail.init(<?=$javascriptParams?>);
	</script>
    <?
}
?>


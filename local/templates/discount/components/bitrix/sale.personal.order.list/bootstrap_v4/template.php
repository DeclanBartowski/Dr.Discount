<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/script.js");
//Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/style.css");
CJSCore::Init(array('clipboard', 'fx'));

Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL'])) {
    foreach ($arResult['ERRORS']['FATAL'] as $code => $error) {
        if ($code !== $component::E_NOT_AUTHORIZED) {
            ShowError($error);
        }
    }
    $component = $this->__component;
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

}
else {
if (!empty($arResult['ERRORS']['NONFATAL'])) {
    foreach ($arResult['ERRORS']['NONFATAL'] as $error) {
        ShowError($error);
    }
}
$tabActive = true;
$paymentChangeData = array();
$orderHeaderStatus = null; ?>
<h6>История заказов</h6>
<div class="orders">
	<ul class="nav nav-pills" id="orders-tab" role="tablist">
        <?
        if (!empty($arResult['CURRENT_ORDERS'])) { ?>
			<li class="nav-item" role="presentation">
				<a class="nav-link<?
                if ($tabActive) {
                    echo ' active';
                }
                $tabActive = false; ?>" id="order-current-tab"
				   data-toggle="pill"
				   href="#order-current" role="tab"
				   aria-controls="order-current"
				   aria-selected="true">Текущие заказы</a>
			</li>
            <?
        } ?>
        <?
        if (!empty($arResult['HISTORY_ORDERS'])) { ?>
			<li class="nav-item" role="presentation">
				<a class="nav-link<?
                if ($tabActive) {
                    echo ' active';
                }
                $tabActive = false; ?>" id="order-history-tab" data-toggle="pill"
				   href="#order-history" role="tab"
				   aria-controls="order-history" aria-selected="false">История
					заказов</a>
			</li>
            <?
        } ?>
        <?
        if (!empty($arResult['CANCELED_ORDERS'])) { ?>
			<li class="nav-item" role="presentation">
				<a class="nav-link<?
                if ($tabActive) {
                    echo ' active';
                }
                $tabActive = false; ?>" id="order-cancel-tab" data-toggle="pill"
				   href="#order-cancel" role="tab"
				   aria-controls="order-cancel" aria-selected="false">Отмененные
					заказы</a>
			</li>
            <?
        } ?>
	</ul>
    <?
    $tabActive = true; ?>
	<div class="tab-content" id="orders-tabContent">
        <?
        if (!empty($arResult['CURRENT_ORDERS'])) { ?>
			<div class="tab-pane fade<?
            if ($tabActive) {
                echo ' show active';
            }
            $tabActive = false; ?>" id="order-current"
			     role="tabpanel"
			     aria-labelledby="order-current-tab">
				<div class="orders__title">
					Заказы в статусе “Принят, ожидается оплата”
				</div>
                <? foreach ($arResult['CURRENT_ORDERS'] as $key => $order) { ?>
					<div class="orders__block">
						<div class="orders__name">
                            <?= Loc::getMessage('SPOL_TPL_ORDER') ?>
                            <?= Loc::getMessage('SPOL_TPL_NUMBER_SIGN') . $order['ORDER']['ACCOUNT_NUMBER'] ?>
                            <?= Loc::getMessage('SPOL_TPL_FROM_DATE') ?>
                            <?= $order['ORDER']['DATE_INSERT_FORMATED'] ?>,
                            <?= count($order['BASKET_ITEMS']); ?>
                            <?
                            $count = count($order['BASKET_ITEMS']) % 10;
                            if ($count == '1') {
                                echo Loc::getMessage('SPOL_TPL_GOOD');
                            } elseif ($count >= '2' && $count <= '4') {
                                echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
                            } else {
                                echo Loc::getMessage('SPOL_TPL_GOODS');
                            }
                            ?>
                            <?= Loc::getMessage('SPOL_TPL_SUMOF') ?>
                            <?= $order['ORDER']['FORMATED_PRICE'] ?>
						</div>
						<div class="orders__item sale-order-list-inner-row">
                            <? $showDelimeter = false;
                            foreach ($order['PAYMENT'] as $payment) {
                                if ($order['ORDER']['LOCK_CHANGE_PAYSYSTEM'] !== 'Y') {
                                    $paymentChangeData[$payment['ACCOUNT_NUMBER']] = array(
                                        "order" => htmlspecialcharsbx($order['ORDER']['ACCOUNT_NUMBER']),
                                        "payment" => htmlspecialcharsbx($payment['ACCOUNT_NUMBER']),
                                        "allow_inner" => $arParams['ALLOW_INNER'],
                                        "refresh_prices" => $arParams['REFRESH_PRICES'],
                                        "path_to_payment" => $arParams['PATH_TO_PAYMENT'],
                                        "only_inner_full" => $arParams['ONLY_INNER_FULL']
                                    );
                                }
                                ?>
								<div class="sale-order-list-inner-row-body">
									<div class="orders__subblock">
										<div class="orders__subtitle">
											Параметры оплаты
										</div>
                                        <? if ($payment['PAID'] !== 'Y' && $order['ORDER']['LOCK_CHANGE_PAYSYSTEM'] !== 'Y') { ?>
											<a href="#" class="sale-order-list-change-payment"
											   id="<?= htmlspecialcharsbx($payment['ACCOUNT_NUMBER']) ?>">Изменить
												способ оплаты</a>
                                        <? } ?>
									</div>
									<div class="sale-order-list-payment">
										<div class="sale-order-list-payment-title orders__check">
                                            <? $paymentSubTitle = Loc::getMessage('SPOL_TPL_BILL') . " " . Loc::getMessage('SPOL_TPL_NUMBER_SIGN') . htmlspecialcharsbx($payment['ACCOUNT_NUMBER']);
                                            if (isset($payment['DATE_BILL'])) {
                                                $paymentSubTitle .= " " . Loc::getMessage('SPOL_TPL_FROM_DATE') . " " . $payment['DATE_BILL_FORMATED'];
                                            }
                                            $paymentSubTitle .= ",";
                                            echo $paymentSubTitle;
                                            ?>
											<span class="sale-order-list-payment-title-element">
									<?= $payment['PAY_SYSTEM_NAME'] ?>
								</span>
										</div>
                                        <? if ($payment['PAID'] === 'Y') { ?>
											<span class="sale-order-list-status-success orders__alert">
									<?= Loc::getMessage('SPOL_TPL_PAID') ?>
								</span>
                                        <? } elseif ($order['ORDER']['IS_ALLOW_PAY'] == 'N') { ?>
											<span class="sale-order-list-status-restricted orders__alert">
										<?= Loc::getMessage('SPOL_TPL_RESTRICTED_PAID') ?>
								</span>
                                        <? } else { ?>
											<span class="sale-order-list-status-alert orders__alert">
									<?= Loc::getMessage('SPOL_TPL_NOTPAID') ?>
								</span>
                                        <? } ?>
										<div class="sale-order-list-payment-price">
											<span class="sale-order-list-payment-element"><?= Loc::getMessage('SPOL_TPL_SUM_TO_PAID') ?>:</span>
											<span class="sale-order-list-payment-number"><?= $payment['FORMATED_SUM'] ?></span>
										</div>
                                        <? if (!empty($payment['CHECK_DATA'])) {
                                            $listCheckLinks = "";
                                            foreach ($payment['CHECK_DATA'] as $checkInfo) {
                                                $title = Loc::getMessage('SPOL_CHECK_NUM',
                                                        array('#CHECK_NUMBER#' => $checkInfo['ID'])) . " - " . htmlspecialcharsbx($checkInfo['TYPE_NAME']);
                                                if (strlen($checkInfo['LINK'])) {
                                                    $link = $checkInfo['LINK'];
                                                    $listCheckLinks .= "<div><a href='$link' target='_blank'>$title</a></div>";
                                                }
                                            }
                                            if (strlen($listCheckLinks) > 0) {
                                                ?>
												<div class="sale-order-list-payment-check">
													<div class="sale-order-list-payment-check-left"><?= Loc::getMessage('SPOL_CHECK_TITLE') ?>
														:
													</div>
													<div class="sale-order-list-payment-check-left"><?= $listCheckLinks ?></div>
												</div>
                                                <?
                                            }
                                        }
                                        if ($order['ORDER']['IS_ALLOW_PAY'] == 'N' && $payment['PAID'] !== 'Y') {
                                            ?>
											<div class="sale-order-list-status-restricted-message-block">
												<span class="sale-order-list-status-restricted-message"><?= Loc::getMessage('SOPL_TPL_RESTRICTED_PAID_MESSAGE') ?></span>
											</div>
                                            <?
                                        }
                                        ?>
									</div>
                                    <?
                                    if ($payment['PAID'] === 'N' && $payment['IS_CASH'] !== 'Y' && $payment['ACTION_FILE'] !== 'cash') {
                                        if ($order['ORDER']['IS_ALLOW_PAY'] == 'N') {
                                            ?>
											<div class="col-sm-auto sale-order-list-button-container">
												<a class="btn btn-primary disabled"><?= Loc::getMessage('SPOL_TPL_PAY') ?></a>
											</div>
                                            <?
                                        } elseif ($payment['NEW_WINDOW'] === 'Y') {
                                            ?>
											<div class="col-sm-auto  sale-order-list-button-container">
												<a class="btn btn-primary" target="_blank"
												   href="<?= htmlspecialcharsbx($payment['PSA_ACTION_FILE']) ?>"><?= Loc::getMessage('SPOL_TPL_PAY') ?></a>
											</div>
                                            <?
                                        } else {
                                            ?>
											<div class="col-sm-auto  sale-order-list-button-container">
												<a class="btn btn-primary ajax_reload"
												   href="<?= htmlspecialcharsbx($payment['PSA_ACTION_FILE']) ?>"><?= Loc::getMessage('SPOL_TPL_PAY') ?></a>
											</div>
                                            <?
                                        }
                                    }
                                    ?>
								</div>
								<div class="sale-order-list-inner-row-template">
									<a class="sale-order-list-cancel-payment" href="">
										<i class="fa fa-long-arrow-left"></i> <?= Loc::getMessage('SPOL_CANCEL_PAYMENT') ?>
									</a>
								</div>
                            <? } ?>
						</div>
                        <? foreach ($order['SHIPMENT'] as $shipment) {
                            if (empty($shipment)) {
                                continue;
                            } ?>
							<div class="orders__item">
								<div class="orders__subblock">
									<div class="orders__subtitle">
										Параметры доставки
									</div>
								</div>

								<div class="sale-order-list-shipment-title orders__check">
                                        <span class="sale-order-list-shipment-element">
                                            <?= Loc::getMessage('SPOL_TPL_LOAD') ?>
                                            <?
                                            $shipmentSubTitle = Loc::getMessage('SPOL_TPL_NUMBER_SIGN') . htmlspecialcharsbx($shipment['ACCOUNT_NUMBER']);
                                            if ($shipment['DATE_DEDUCTED']) {
                                                $shipmentSubTitle .= " " . Loc::getMessage('SPOL_TPL_FROM_DATE') . " " . $shipment['DATE_DEDUCTED_FORMATED'];
                                            }

                                            if ($shipment['FORMATED_DELIVERY_PRICE']) {
                                                $shipmentSubTitle .= ", " . Loc::getMessage('SPOL_TPL_DELIVERY_COST') . " " . $shipment['FORMATED_DELIVERY_PRICE'];
                                            }
                                            echo $shipmentSubTitle;
                                            ?>
                                        </span>
								</div>

								<div class="orders__alert">
                                    <?
                                    if ($shipment['DEDUCTED'] == 'Y') {
                                        ?>
										<span class="sale-order-list-status-success"><?= Loc::getMessage('SPOL_TPL_LOADED'); ?></span>
                                        <?
                                    } else {
                                        ?>
										<span class="sale-order-list-status-alert"><?= Loc::getMessage('SPOL_TPL_NOTLOADED'); ?></span>
                                        <?
                                    }
                                    ?>
								</div>
								<div class="orders__status">
									Статус отгрузки: <span class="text-blue">
										<?= htmlspecialcharsbx($shipment['DELIVERY_STATUS_NAME']) ?>
									</span>
								</div>
								<p>
                                    <? if (!empty($shipment['DELIVERY_ID'])) { ?>
								<div class="sale-order-list-shipment-item">
                                    <?= Loc::getMessage('SPOL_TPL_DELIVERY_SERVICE') ?>
									: <?= $arResult['INFO']['DELIVERY'][$shipment['DELIVERY_ID']]['NAME'] ?>
								</div>
                                <? } ?>
                                <? if (!empty($shipment['TRACKING_NUMBER'])) { ?>
									<div class="sale-order-list-shipment-item">
												<span class="sale-order-list-shipment-id-name">
													<?= Loc::getMessage('SPOL_TPL_POSTID') ?>:
												</span>
										<span class="sale-order-list-shipment-id">
													<?= htmlspecialcharsbx($shipment['TRACKING_NUMBER']) ?>
												</span>
										<span class="sale-order-list-shipment-id-icon"></span>
									</div>
                                <? } ?>
                                <? if (strlen($shipment['TRACKING_URL']) > 0) { ?>
									<div class="sale-order-list-shipment-button-container">
										<a class="sale-order-list-shipment-button" target="_blank"
										   href="<?= $shipment['TRACKING_URL'] ?>">
                                            <?= Loc::getMessage('SPOL_TPL_CHECK_POSTID') ?>
										</a>
									</div>
                                <? } ?>
								</p>
							</div>
                        <? } ?>
						<div class="orders__item">
							<div class="btns-wrapper">
								<a href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_DETAIL"]); ?>"
								   class="bnt btn-primary">
                                    <?= Loc::getMessage('SPOL_TPL_MORE_ON_ORDER'); ?>
								</a>
								<a href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"]); ?>"
								   class="btn btn-secondary">
                                    <?= Loc::getMessage('SPOL_TPL_REPEAT_ORDER'); ?>
								</a>
                                <? if ($order['ORDER']['CAN_CANCEL'] !== 'N') { ?>
									<a href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_CANCEL"]); ?>"
									   class="btn btn-secondary">
                                        <?= Loc::getMessage('SPOL_TPL_CANCEL_ORDER'); ?>
									</a>
                                <? } ?>
							</div>
						</div>
					</div>
                <? } ?>
			</div>
            <?
        } ?>
        <?
        if (!empty($arResult['HISTORY_ORDERS'])) { ?>
			<div class="tab-pane fade<?
            if ($tabActive) {
                echo ' show active';
            }
            $tabActive = false; ?>" id="order-history" role="tabpanel"
			     aria-labelledby="order-cancel-tab">
				<div class="orders__title">
					Заказы в статусе “Выполнен”
				</div>
                <? foreach ($arResult['HISTORY_ORDERS'] as $key => $order) { ?>
					<div class="orders__block">
						<div class="orders__name">
                            <?= Loc::getMessage('SPOL_TPL_ORDER') ?>
                            <?= Loc::getMessage('SPOL_TPL_NUMBER_SIGN') . $order['ORDER']['ACCOUNT_NUMBER'] ?>
                            <?= Loc::getMessage('SPOL_TPL_FROM_DATE') ?>
                            <?= $order['ORDER']['DATE_INSERT_FORMATED'] ?>,
                            <?= count($order['BASKET_ITEMS']); ?>
                            <?
                            $count = count($order['BASKET_ITEMS']) % 10;
                            if ($count == '1') {
                                echo Loc::getMessage('SPOL_TPL_GOOD');
                            } elseif ($count >= '2' && $count <= '4') {
                                echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
                            } else {
                                echo Loc::getMessage('SPOL_TPL_GOODS');
                            }
                            ?>
                            <?= Loc::getMessage('SPOL_TPL_SUMOF') ?>
                            <?= $order['ORDER']['FORMATED_PRICE'] ?>
						</div>
						<div class="orders__item sale-order-list-inner-row">
                            <? $showDelimeter = false;
                            foreach ($order['PAYMENT'] as $payment) {
                                if ($order['ORDER']['LOCK_CHANGE_PAYSYSTEM'] !== 'Y') {
                                    $paymentChangeData[$payment['ACCOUNT_NUMBER']] = array(
                                        "order" => htmlspecialcharsbx($order['ORDER']['ACCOUNT_NUMBER']),
                                        "payment" => htmlspecialcharsbx($payment['ACCOUNT_NUMBER']),
                                        "allow_inner" => $arParams['ALLOW_INNER'],
                                        "refresh_prices" => $arParams['REFRESH_PRICES'],
                                        "path_to_payment" => $arParams['PATH_TO_PAYMENT'],
                                        "only_inner_full" => $arParams['ONLY_INNER_FULL']
                                    );
                                }
                                ?>
								<div class="sale-order-list-inner-row-body">
									<div class="orders__subblock">
										<div class="orders__subtitle">
											Параметры оплаты
										</div>
                                        <? if ($payment['PAID'] !== 'Y' && $order['ORDER']['LOCK_CHANGE_PAYSYSTEM'] !== 'Y') { ?>
											<a href="#" class="sale-order-list-change-payment"
											   id="<?= htmlspecialcharsbx($payment['ACCOUNT_NUMBER']) ?>">Изменить
												способ оплаты</a>
                                        <? } ?>
									</div>
									<div class="sale-order-list-payment">
										<div class="sale-order-list-payment-title orders__check">
                                            <? $paymentSubTitle = Loc::getMessage('SPOL_TPL_BILL') . " " . Loc::getMessage('SPOL_TPL_NUMBER_SIGN') . htmlspecialcharsbx($payment['ACCOUNT_NUMBER']);
                                            if (isset($payment['DATE_BILL'])) {
                                                $paymentSubTitle .= " " . Loc::getMessage('SPOL_TPL_FROM_DATE') . " " . $payment['DATE_BILL_FORMATED'];
                                            }
                                            $paymentSubTitle .= ",";
                                            echo $paymentSubTitle;
                                            ?>
											<span class="sale-order-list-payment-title-element">
									<?= $payment['PAY_SYSTEM_NAME'] ?>
								</span>
										</div>
                                        <? if ($payment['PAID'] === 'Y') { ?>
											<span class="sale-order-list-status-success orders__alert">
									<?= Loc::getMessage('SPOL_TPL_PAID') ?>
								</span>
                                        <? } elseif ($order['ORDER']['IS_ALLOW_PAY'] == 'N') { ?>
											<span class="sale-order-list-status-restricted orders__alert">
										<?= Loc::getMessage('SPOL_TPL_RESTRICTED_PAID') ?>
								</span>
                                        <? } else { ?>
											<span class="sale-order-list-status-alert orders__alert">
									<?= Loc::getMessage('SPOL_TPL_NOTPAID') ?>
								</span>
                                        <? } ?>
										<div class="sale-order-list-payment-price">
											<span class="sale-order-list-payment-element"><?= Loc::getMessage('SPOL_TPL_SUM_TO_PAID') ?>:</span>
											<span class="sale-order-list-payment-number"><?= $payment['FORMATED_SUM'] ?></span>
										</div>
                                        <? if (!empty($payment['CHECK_DATA'])) {
                                            $listCheckLinks = "";
                                            foreach ($payment['CHECK_DATA'] as $checkInfo) {
                                                $title = Loc::getMessage('SPOL_CHECK_NUM',
                                                        array('#CHECK_NUMBER#' => $checkInfo['ID'])) . " - " . htmlspecialcharsbx($checkInfo['TYPE_NAME']);
                                                if (strlen($checkInfo['LINK'])) {
                                                    $link = $checkInfo['LINK'];
                                                    $listCheckLinks .= "<div><a href='$link' target='_blank'>$title</a></div>";
                                                }
                                            }
                                            if (strlen($listCheckLinks) > 0) {
                                                ?>
												<div class="sale-order-list-payment-check">
													<div class="sale-order-list-payment-check-left"><?= Loc::getMessage('SPOL_CHECK_TITLE') ?>
														:
													</div>
													<div class="sale-order-list-payment-check-left"><?= $listCheckLinks ?></div>
												</div>
                                                <?
                                            }
                                        }
                                        if ($order['ORDER']['IS_ALLOW_PAY'] == 'N' && $payment['PAID'] !== 'Y') {
                                            ?>
											<div class="sale-order-list-status-restricted-message-block">
												<span class="sale-order-list-status-restricted-message"><?= Loc::getMessage('SOPL_TPL_RESTRICTED_PAID_MESSAGE') ?></span>
											</div>
                                            <?
                                        }
                                        ?>
									</div>
                                    <?
                                    if ($payment['PAID'] === 'N' && $payment['IS_CASH'] !== 'Y' && $payment['ACTION_FILE'] !== 'cash') {
                                        if ($order['ORDER']['IS_ALLOW_PAY'] == 'N') {
                                            ?>
											<div class="col-sm-auto sale-order-list-button-container">
												<a class="btn btn-primary disabled"><?= Loc::getMessage('SPOL_TPL_PAY') ?></a>
											</div>
                                            <?
                                        } elseif ($payment['NEW_WINDOW'] === 'Y') {
                                            ?>
											<div class="col-sm-auto  sale-order-list-button-container">
												<a class="btn btn-primary" target="_blank"
												   href="<?= htmlspecialcharsbx($payment['PSA_ACTION_FILE']) ?>"><?= Loc::getMessage('SPOL_TPL_PAY') ?></a>
											</div>
                                            <?
                                        } else {
                                            ?>
											<div class="col-sm-auto  sale-order-list-button-container">
												<a class="btn btn-primary ajax_reload"
												   href="<?= htmlspecialcharsbx($payment['PSA_ACTION_FILE']) ?>"><?= Loc::getMessage('SPOL_TPL_PAY') ?></a>
											</div>
                                            <?
                                        }
                                    }
                                    ?>
								</div>
								<div class="sale-order-list-inner-row-template">
									<a class="sale-order-list-cancel-payment" href="">
										<i class="fa fa-long-arrow-left"></i> <?= Loc::getMessage('SPOL_CANCEL_PAYMENT') ?>
									</a>
								</div>
                            <? } ?>
						</div>
                        <? foreach ($order['SHIPMENT'] as $shipment) {
                            if (empty($shipment)) {
                                continue;
                            } ?>
							<div class="orders__item">
								<div class="orders__subblock">
									<div class="orders__subtitle">
										Параметры доставки
									</div>
								</div>

								<div class="sale-order-list-shipment-title orders__check">
                                        <span class="sale-order-list-shipment-element">
                                            <?= Loc::getMessage('SPOL_TPL_LOAD') ?>
                                            <?
                                            $shipmentSubTitle = Loc::getMessage('SPOL_TPL_NUMBER_SIGN') . htmlspecialcharsbx($shipment['ACCOUNT_NUMBER']);
                                            if ($shipment['DATE_DEDUCTED']) {
                                                $shipmentSubTitle .= " " . Loc::getMessage('SPOL_TPL_FROM_DATE') . " " . $shipment['DATE_DEDUCTED_FORMATED'];
                                            }

                                            if ($shipment['FORMATED_DELIVERY_PRICE']) {
                                                $shipmentSubTitle .= ", " . Loc::getMessage('SPOL_TPL_DELIVERY_COST') . " " . $shipment['FORMATED_DELIVERY_PRICE'];
                                            }
                                            echo $shipmentSubTitle;
                                            ?>
                                        </span>
								</div>

								<div class="orders__alert">
                                    <?
                                    if ($shipment['DEDUCTED'] == 'Y') {
                                        ?>
										<span class="sale-order-list-status-success"><?= Loc::getMessage('SPOL_TPL_LOADED'); ?></span>
                                        <?
                                    } else {
                                        ?>
										<span class="sale-order-list-status-alert"><?= Loc::getMessage('SPOL_TPL_NOTLOADED'); ?></span>
                                        <?
                                    }
                                    ?>
								</div>
								<div class="orders__status">
									Статус отгрузки: <span class="text-blue">
										<?= htmlspecialcharsbx($shipment['DELIVERY_STATUS_NAME']) ?>
									</span>
								</div>
								<p>
                                    <? if (!empty($shipment['DELIVERY_ID'])) { ?>
								<div class="sale-order-list-shipment-item">
                                    <?= Loc::getMessage('SPOL_TPL_DELIVERY_SERVICE') ?>
									: <?= $arResult['INFO']['DELIVERY'][$shipment['DELIVERY_ID']]['NAME'] ?>
								</div>
                                <? } ?>
                                <? if (!empty($shipment['TRACKING_NUMBER'])) { ?>
									<div class="sale-order-list-shipment-item">
												<span class="sale-order-list-shipment-id-name">
													<?= Loc::getMessage('SPOL_TPL_POSTID') ?>:
												</span>
										<span class="sale-order-list-shipment-id">
													<?= htmlspecialcharsbx($shipment['TRACKING_NUMBER']) ?>
												</span>
										<span class="sale-order-list-shipment-id-icon"></span>
									</div>
                                <? } ?>
                                <? if (strlen($shipment['TRACKING_URL']) > 0) { ?>
									<div class="sale-order-list-shipment-button-container">
										<a class="sale-order-list-shipment-button" target="_blank"
										   href="<?= $shipment['TRACKING_URL'] ?>">
                                            <?= Loc::getMessage('SPOL_TPL_CHECK_POSTID') ?>
										</a>
									</div>
                                <? } ?>
								</p>
							</div>
                        <? } ?>
						<div class="orders__item">
							<div class="btns-wrapper">
								<a href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_DETAIL"]); ?>"
								   class="bnt btn-primary">
                                    <?= Loc::getMessage('SPOL_TPL_MORE_ON_ORDER'); ?>
								</a>
								<a href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"]); ?>"
								   class="btn btn-secondary">
                                    <?= Loc::getMessage('SPOL_TPL_REPEAT_ORDER'); ?>
								</a>
                                <? if ($order['ORDER']['CAN_CANCEL'] !== 'N') { ?>
									<a href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_CANCEL"]); ?>"
									   class="btn btn-secondary">
                                        <?= Loc::getMessage('SPOL_TPL_CANCEL_ORDER'); ?>
									</a>
                                <? } ?>
							</div>
						</div>
					</div>
                <? } ?>
			</div>
            <?
        } ?>
        <?
        if (!empty($arResult['CANCELED_ORDERS'])) { ?>
			<div class="tab-pane fade<?
            if ($tabActive) {
                echo ' show active';
            }
            $tabActive = false; ?>" id="order-cancel" role="tabpanel"
			     aria-labelledby="order-cancel-tab">
				<div class="orders__title">
					Заказы в статусе “Отменен”
				</div>
                <? foreach ($arResult['CANCELED_ORDERS'] as $key => $order) { ?>
					<div class="orders__block">
						<div class="orders__name">
                            <?= Loc::getMessage('SPOL_TPL_ORDER') ?>
                            <?= Loc::getMessage('SPOL_TPL_NUMBER_SIGN') . $order['ORDER']['ACCOUNT_NUMBER'] ?>
                            <?= Loc::getMessage('SPOL_TPL_FROM_DATE') ?>
                            <?= $order['ORDER']['DATE_INSERT_FORMATED'] ?>,
                            <?= count($order['BASKET_ITEMS']); ?>
                            <?
                            $count = count($order['BASKET_ITEMS']) % 10;
                            if ($count == '1') {
                                echo Loc::getMessage('SPOL_TPL_GOOD');
                            } elseif ($count >= '2' && $count <= '4') {
                                echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
                            } else {
                                echo Loc::getMessage('SPOL_TPL_GOODS');
                            }
                            ?>
                            <?= Loc::getMessage('SPOL_TPL_SUMOF') ?>
                            <?= $order['ORDER']['FORMATED_PRICE'] ?>
						</div>
						<div class="orders__item sale-order-list-inner-row">
                            <? $showDelimeter = false;
                            foreach ($order['PAYMENT'] as $payment) {
                                if ($order['ORDER']['LOCK_CHANGE_PAYSYSTEM'] !== 'Y') {
                                    $paymentChangeData[$payment['ACCOUNT_NUMBER']] = array(
                                        "order" => htmlspecialcharsbx($order['ORDER']['ACCOUNT_NUMBER']),
                                        "payment" => htmlspecialcharsbx($payment['ACCOUNT_NUMBER']),
                                        "allow_inner" => $arParams['ALLOW_INNER'],
                                        "refresh_prices" => $arParams['REFRESH_PRICES'],
                                        "path_to_payment" => $arParams['PATH_TO_PAYMENT'],
                                        "only_inner_full" => $arParams['ONLY_INNER_FULL']
                                    );
                                }
                                ?>
								<div class="sale-order-list-inner-row-body">
									<div class="orders__subblock">
										<div class="orders__subtitle">
											Параметры оплаты
										</div>
                                        <? if ($payment['PAID'] !== 'Y' && $order['ORDER']['LOCK_CHANGE_PAYSYSTEM'] !== 'Y') { ?>
											<a href="#" class="sale-order-list-change-payment"
											   id="<?= htmlspecialcharsbx($payment['ACCOUNT_NUMBER']) ?>">Изменить
												способ оплаты</a>
                                        <? } ?>
									</div>
									<div class="sale-order-list-payment">
										<div class="sale-order-list-payment-title orders__check">
                                            <? $paymentSubTitle = Loc::getMessage('SPOL_TPL_BILL') . " " . Loc::getMessage('SPOL_TPL_NUMBER_SIGN') . htmlspecialcharsbx($payment['ACCOUNT_NUMBER']);
                                            if (isset($payment['DATE_BILL'])) {
                                                $paymentSubTitle .= " " . Loc::getMessage('SPOL_TPL_FROM_DATE') . " " . $payment['DATE_BILL_FORMATED'];
                                            }
                                            $paymentSubTitle .= ",";
                                            echo $paymentSubTitle;
                                            ?>
											<span class="sale-order-list-payment-title-element">
									<?= $payment['PAY_SYSTEM_NAME'] ?>
								</span>
										</div>
                                        <? if ($payment['PAID'] === 'Y') { ?>
											<span class="sale-order-list-status-success orders__alert">
									<?= Loc::getMessage('SPOL_TPL_PAID') ?>
								</span>
                                        <? } elseif ($order['ORDER']['IS_ALLOW_PAY'] == 'N') { ?>
											<span class="sale-order-list-status-restricted orders__alert">
										<?= Loc::getMessage('SPOL_TPL_RESTRICTED_PAID') ?>
								</span>
                                        <? } else { ?>
											<span class="sale-order-list-status-alert orders__alert">
									<?= Loc::getMessage('SPOL_TPL_NOTPAID') ?>
								</span>
                                        <? } ?>
										<div class="sale-order-list-payment-price">
											<span class="sale-order-list-payment-element"><?= Loc::getMessage('SPOL_TPL_SUM_TO_PAID') ?>:</span>
											<span class="sale-order-list-payment-number"><?= $payment['FORMATED_SUM'] ?></span>
										</div>
                                        <? if (!empty($payment['CHECK_DATA'])) {
                                            $listCheckLinks = "";
                                            foreach ($payment['CHECK_DATA'] as $checkInfo) {
                                                $title = Loc::getMessage('SPOL_CHECK_NUM',
                                                        array('#CHECK_NUMBER#' => $checkInfo['ID'])) . " - " . htmlspecialcharsbx($checkInfo['TYPE_NAME']);
                                                if (strlen($checkInfo['LINK'])) {
                                                    $link = $checkInfo['LINK'];
                                                    $listCheckLinks .= "<div><a href='$link' target='_blank'>$title</a></div>";
                                                }
                                            }
                                            if (strlen($listCheckLinks) > 0) {
                                                ?>
												<div class="sale-order-list-payment-check">
													<div class="sale-order-list-payment-check-left"><?= Loc::getMessage('SPOL_CHECK_TITLE') ?>
														:
													</div>
													<div class="sale-order-list-payment-check-left"><?= $listCheckLinks ?></div>
												</div>
                                                <?
                                            }
                                        }
                                        if ($order['ORDER']['IS_ALLOW_PAY'] == 'N' && $payment['PAID'] !== 'Y') {
                                            ?>
											<div class="sale-order-list-status-restricted-message-block">
												<span class="sale-order-list-status-restricted-message"><?= Loc::getMessage('SOPL_TPL_RESTRICTED_PAID_MESSAGE') ?></span>
											</div>
                                            <?
                                        }
                                        ?>
									</div>
                                    <?
                                    if ($payment['PAID'] === 'N' && $payment['IS_CASH'] !== 'Y' && $payment['ACTION_FILE'] !== 'cash') {
                                        if ($order['ORDER']['IS_ALLOW_PAY'] == 'N') {
                                            ?>
											<div class="col-sm-auto sale-order-list-button-container">
												<a class="btn btn-primary disabled"><?= Loc::getMessage('SPOL_TPL_PAY') ?></a>
											</div>
                                            <?
                                        } elseif ($payment['NEW_WINDOW'] === 'Y') {
                                            ?>
											<div class="col-sm-auto  sale-order-list-button-container">
												<a class="btn btn-primary" target="_blank"
												   href="<?= htmlspecialcharsbx($payment['PSA_ACTION_FILE']) ?>"><?= Loc::getMessage('SPOL_TPL_PAY') ?></a>
											</div>
                                            <?
                                        } else {
                                            ?>
											<div class="col-sm-auto  sale-order-list-button-container">
												<a class="btn btn-primary ajax_reload"
												   href="<?= htmlspecialcharsbx($payment['PSA_ACTION_FILE']) ?>"><?= Loc::getMessage('SPOL_TPL_PAY') ?></a>
											</div>
                                            <?
                                        }
                                    }
                                    ?>
								</div>
								<div class="sale-order-list-inner-row-template">
									<a class="sale-order-list-cancel-payment" href="">
										<i class="fa fa-long-arrow-left"></i> <?= Loc::getMessage('SPOL_CANCEL_PAYMENT') ?>
									</a>
								</div>
                            <? } ?>
						</div>
                        <? foreach ($order['SHIPMENT'] as $shipment) {
                            if (empty($shipment)) {
                                continue;
                            } ?>
							<div class="orders__item">
								<div class="orders__subblock">
									<div class="orders__subtitle">
										Параметры доставки
									</div>
								</div>

								<div class="sale-order-list-shipment-title orders__check">
                                        <span class="sale-order-list-shipment-element">
                                            <?= Loc::getMessage('SPOL_TPL_LOAD') ?>
                                            <?
                                            $shipmentSubTitle = Loc::getMessage('SPOL_TPL_NUMBER_SIGN') . htmlspecialcharsbx($shipment['ACCOUNT_NUMBER']);
                                            if ($shipment['DATE_DEDUCTED']) {
                                                $shipmentSubTitle .= " " . Loc::getMessage('SPOL_TPL_FROM_DATE') . " " . $shipment['DATE_DEDUCTED_FORMATED'];
                                            }

                                            if ($shipment['FORMATED_DELIVERY_PRICE']) {
                                                $shipmentSubTitle .= ", " . Loc::getMessage('SPOL_TPL_DELIVERY_COST') . " " . $shipment['FORMATED_DELIVERY_PRICE'];
                                            }
                                            echo $shipmentSubTitle;
                                            ?>
                                        </span>
								</div>

								<div class="orders__alert">
                                    <?
                                    if ($shipment['DEDUCTED'] == 'Y') {
                                        ?>
										<span class="sale-order-list-status-success"><?= Loc::getMessage('SPOL_TPL_LOADED'); ?></span>
                                        <?
                                    } else {
                                        ?>
										<span class="sale-order-list-status-alert"><?= Loc::getMessage('SPOL_TPL_NOTLOADED'); ?></span>
                                        <?
                                    }
                                    ?>
								</div>
								<div class="orders__status">
									Статус отгрузки: <span class="text-blue">
										<?= htmlspecialcharsbx($shipment['DELIVERY_STATUS_NAME']) ?>
									</span>
								</div>
								<p>
                                    <? if (!empty($shipment['DELIVERY_ID'])) { ?>
								<div class="sale-order-list-shipment-item">
                                    <?= Loc::getMessage('SPOL_TPL_DELIVERY_SERVICE') ?>
									: <?= $arResult['INFO']['DELIVERY'][$shipment['DELIVERY_ID']]['NAME'] ?>
								</div>
                                <? } ?>
                                <? if (!empty($shipment['TRACKING_NUMBER'])) { ?>
									<div class="sale-order-list-shipment-item">
												<span class="sale-order-list-shipment-id-name">
													<?= Loc::getMessage('SPOL_TPL_POSTID') ?>:
												</span>
										<span class="sale-order-list-shipment-id">
													<?= htmlspecialcharsbx($shipment['TRACKING_NUMBER']) ?>
												</span>
										<span class="sale-order-list-shipment-id-icon"></span>
									</div>
                                <? } ?>
                                <? if (strlen($shipment['TRACKING_URL']) > 0) { ?>
									<div class="sale-order-list-shipment-button-container">
										<a class="sale-order-list-shipment-button" target="_blank"
										   href="<?= $shipment['TRACKING_URL'] ?>">
                                            <?= Loc::getMessage('SPOL_TPL_CHECK_POSTID') ?>
										</a>
									</div>
                                <? } ?>
								</p>
							</div>
                        <? } ?>
						<div class="orders__item">
							<div class="btns-wrapper">
								<a href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_DETAIL"]); ?>"
								   class="bnt btn-primary">
                                    <?= Loc::getMessage('SPOL_TPL_MORE_ON_ORDER'); ?>
								</a>
								<a href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"]); ?>"
								   class="btn btn-secondary">
                                    <?= Loc::getMessage('SPOL_TPL_REPEAT_ORDER'); ?>
								</a>
                                <? if ($order['ORDER']['CAN_CANCEL'] !== 'N') { ?>
									<a href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_CANCEL"]); ?>"
									   class="btn btn-secondary">
                                        <?= Loc::getMessage('SPOL_TPL_CANCEL_ORDER'); ?>
									</a>
                                <? } ?>
							</div>
						</div>
					</div>
                <? } ?>
			</div>
            <?
        } ?>
	</div>

    <? if ($_REQUEST["filter_history"] !== 'Y') {
        $javascriptParams = array(
            "url" => CUtil::JSEscape($this->__component->GetPath() . '/ajax.php'),
            "templateFolder" => CUtil::JSEscape($templateFolder),
            "templateName" => $this->__component->GetTemplateName(),
            "paymentList" => $paymentChangeData
        );
        $javascriptParams = CUtil::PhpToJSObject($javascriptParams);
        ?>
		<script>
            BX.Sale.PersonalOrderComponent.PersonalOrderList.init(<?=$javascriptParams?>);
		</script>
        <?
    }
    }
    ?>

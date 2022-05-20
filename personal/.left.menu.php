<?
$aMenuLinks = Array(
	Array(
		"Личные данный", 
		"/personal/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Корзина", 
		"/basket/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"История заказов", 
		"/personal/orders/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Избранные товары", 
		"", 
		Array(), 
		Array("COUNTER"=>"echo count(\$_SESSION['FAVORITES']);"), 
		"" 
	),
	Array(
		"Рекомендуемые товары", 
		"", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Выйти", 
		"?logout=yes", 
		Array(), 
		Array(), 
		"" 
	)
);
?>
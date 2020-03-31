(function(window, document, $, undefined) {
	  "use strict";
	$(function() {

		// basic
		$("#s2_demo1").select2({
		    placeholder: "выберите товар"
		});

		// nested
		$('#s2_demo2').select2({
		    placeholder: "выберите поток"
		});

		// multi select
		$('#s2_demo3').select2();

		// placeholder
		$("#s2_demo4").select2();

		// Minimum Input
		$("#s2_demo5").select2();
		$("#s2_demo6").select2();
		$("#s2_demo7").select2();
		$("#s2_demo8").select2();
		$("#s2_demo9").select2();

		$("#s2_demo10").select2({
		    placeholder: "статус заказа"
		});
		
		$("#s2_demo11").select2({
		    placeholder: "статус доставки"
		});
		
		
		$("#s2_demo12").select2();
		$("#s2_demo13").select2();
		$("#s2_demo14").select2();
		$("#s2_demo15").select2();

	});

})(window, document, window.jQuery);
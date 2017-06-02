//����������
//author:kingapex
(function($) {

	$.fn.numinput = function(options) {
		
		var opts = $.extend({}, $.fn.numinput.defaults, options);
		
		return this.each(function(){
			createEl($(this));
			bindEvent($(this));
		});		
	
		
		function createEl(target){
			var value=1;
			if(target.attr("value")) value=target.attr("value");
			input=$("<input type=\"text\" value=\""+value+"\" oldValue=\"" +value + "\" size=\"5\" name=\""+opts.name+"\" autocomplete=\"off\">");
			incBtn =$('<span class="numadjust increase">+</span>');
			decBtn =$('<span class="numadjust decrease">-</span>');
			target.append(decBtn).append(input).append(incBtn);
		}
		 
		
		function fireEvent(input){			
			input.attr("oldValue",input.val());
			if(opts.onChange){
				if(input.val()=="" ){alert("���ָ�ʽ����ȷ");input.val(input.attr("oldValue"));}
				opts.onChange(input);
			}
		}
        
		function bindEvent(target){
			var input,incBtn,decBtn;
			var input =target.children("input");
			var incBtn =target.children("span.increase");
			var decBtn =target.children("span.decrease");
			incBtn
			.mousedown(function(){
				$(this).addClass("active");
			})
			.mouseup(function(){
				$(this).removeClass("active");
				if(parseInt(input.val()) < 100){
					input.val(parseInt(input.val())+1);
					fireEvent(input);
				}
			});

			decBtn
			.mousedown(function(){
				$(this).addClass("active");
			})
			.mouseup(function(){
				$(this).removeClass("active");
				input.val( parseInt(input.val())== opts.min ? opts.min :parseInt(input.val()) -1);
				fireEvent(input);
			});
			
			input.keypress(function(event) {  
			         if (!$.browser.mozilla) {  
				             if (event.keyCode && (event.keyCode < 48 || event.keyCode > 57)) {  
				                 event.preventDefault();  
				             }  
				         } else {  
				             if (event.charCode && (event.charCode < 48 || event.charCode > 57)) {  
				                 event.preventDefault();  
				             }  
				         }  
			}); 
			
			input.change(function(){
				var $this = $(this);
				var value =$this.val();
			
				var result = true;
				if( $.trim(value)==''){
					alert("������������");
					input.val($this.attr("oldValue"));
					return false;
				}
				
				if(result && parseInt($.trim(value)) < opts.min ){
					alert("��������С��" + opts.min + "��");
					input.val($this.attr("oldValue"));
					return false;
				}
				if(result && parseInt($.trim(value)) > 100){
					alert("�������ܴ��ڿ�棡");
					input.val($this.attr("oldValue"));
					return false;
				}
								
				if(  result && !$.isNumber(value) ){
					alert("�������������֣�");
					input.val($this.attr("oldValue"));
					return false;
				}
				
				if(result){
					fireEvent($this);
				}else{
					$this.val(1);
				}
				
			});
		}
		
	};
	
	$.fn.numinput.defaults={min:1};
})(jQuery);
;jQuery(document).ready(function($) {
	var jqElemsAccordions = $(".ci-accordion");
	if (jqElemsAccordions.length === 0) return;
	
	(function() {
		Accordion = function(jqElem) {
			this.jqElem = jqElem;
			this.jqElemHead = $("<div/>", {
				"class": "ci-accordion__head", 
				"role": "button", 
				"aria-expanded": "false", 
				"tabindex": 0}).prependTo(this.jqElem);
			this.jqElemTitle = jqElem.find(".ci-accordion__title:first");
			this.jqElemContent = this.jqElemTitle.next();
			this.jqElemTitle.appendTo(this.jqElemHead);
			this.isOpen = false;
			
			(function(_obj) {
				_obj.jqElemHead.keypress(function(e) {
					$key = e.which;
					//13 enter, 32 space
					if ($key === 13 || $key === 32) {
						e.preventDefault();
						_obj.toggleContent();
					}
				});
				_obj.jqElemHead.click(function(e) {
					e.preventDefault();
					_obj.toggleContent();
				});
				
			}).call(this, this);
		};
		
		Accordion.prototype.toggleContent = function() {
			if (this.isOpen) {
				this.closeContent();
			} else {
				this.openContent();
			}
		}
		
		Accordion.prototype.openContent = function(speed) {
			var _obj = this;
			this.jqElemContent.stop(true).slideDown(speed || '');
			this.jqElem.attr('aria-expanded', true);
			this.isOpen = true;
		}
		
		Accordion.prototype.closeContent = function(speed) {
			var _obj = this;
			this.jqElemContent.stop(true).slideUp(speed || '', function() {
				_obj.jqElem.attr('aria-expanded', false);
			});
			this.isOpen = false;
		}
		
		jqElemsAccordions.each(function() {
			new Accordion($(this));
		});
		
	})();
});
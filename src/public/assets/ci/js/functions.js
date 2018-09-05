;jQuery(document).ready(function($) {
	var jqElemsAccordions = $(".ci-accordion");
	if (jqElemsAccordions.length === 0) return;
	
	(function() {
		Accordion = function(jqElem) {
			this.jqElem = jqElem;
			this.jqElemTitle = jqElem.find(".ci-accordion-title:first");
			this.jqElemContent = this.jqElemTitle.next();
			this.isOpen = false;
			
			(function(_obj) {
				_obj.closeContent(-1);
				_obj.jqElemTitle.click(function() {
					if (_obj.isOpen) {
						_obj.closeContent();
					} else {
						_obj.openContent();
					}
				});
				
			}).call(this, this);
		};
		
		Accordion.prototype.openContent = function(speed) {
			var _obj = this;
			this.jqElemContent.stop(true, true).slideDown(speed || '');
			this.jqElem.addClass("ci-accordion-open");
			this.jqElem.removeClass("ci-accordion-close");
			this.isOpen = true;
		}
		
		Accordion.prototype.closeContent = function(speed) {
			this.jqElemContent.stop(true, true).slideUp(speed || '');
			this.jqElem.addClass("ci-accordion-close");
			this.jqElem.removeClass("ci-accordion-open");
			this.isOpen = false;
		}
		
		jqElemsAccordions.each(function() {
			new Accordion($(this));
		});
		
	})();
});
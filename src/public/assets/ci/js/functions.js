;jQuery(document).ready(function($) {
	var jqElemsAccordions = $(".ci-accordion");
	if (jqElemsAccordions.length === 0) return;
	
	(function() {
		Accordion = function(jqElem) {
			this.jqElem = jqElem;
			this.jqElemTitle = jqElem.find(".ci-accordion__head:first");
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
		
		Accordion.CLOSE_CLASSNAME = 'ci-accordion--closed';
		Accordion.OPEN_CLASSNAME = 'ci-accordion--open';
		
		Accordion.prototype.openContent = function(speed) {
			var _obj = this;
			this.jqElemContent.stop(true, true).slideDown(speed || '');
			this.jqElem.addClass(Accordion.OPEN_CLASSNAME);
			this.jqElem.removeClass(Accordion.CLOSE_CLASSNAME);
			this.isOpen = true;
		}
		
		Accordion.prototype.closeContent = function(speed) {
			var _obj = this;
			this.jqElemContent.stop(true, true).slideUp(speed || '', function() {
				_obj.jqElem.removeClass(Accordion.OPEN_CLASSNAME);
				_obj.jqElem.addClass(Accordion.CLOSE_CLASSNAME);
			});
			this.isOpen = false;
		}
		
		jqElemsAccordions.each(function() {
			new Accordion($(this));
		});
		
	})();
});
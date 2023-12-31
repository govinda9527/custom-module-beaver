(function($){
    GOCMBBFields = {
        _init: function()
        {   
            FLBuilder.addHook('settings-form-init', function() {
                GOCMBBFields._initRadioFields();
            });
            GOCMBBFields._bindEvents();
        },
        _bindEvents: function()
        {
            $('body').delegate( '.njba-simplify-wrapper .simplify', 'click', GOCMBBFields._toggleExapndCollapse);
            $('body').delegate('.fl-builder-settings-fields .njba-field-radio', 'change', GOCMBBFields._settingsRadioChanged);
            /*$('body').delegate('.njba-help-tooltip', 'mouseover', GOCMBBFields._showHelpTooltip);
            $('body').delegate('.njba-help-tooltip', 'mouseout', GOCMBBFields._hideHelpTooltip);*/
        },
        _initRadioFields: function()
        {
            $('.fl-builder-settings:visible').find('.fl-builder-settings-fields input[type="radio"]').trigger('change');
            $('.fl-builder-settings:visible').find('.fl-builder-settings-fields input[type="radio"]:checked').parent().addClass('selected');
        },
        _settingsRadioChanged: function()
        {
            var input   = $(this),
                control = input.attr('name'),
                field   = $('input[data-name="'+control+'"]'),
                toggle  = field.attr('data-toggle'),
                hide    = field.attr('data-hide'),
                trigger = field.attr('data-trigger'),
                val     = field.val(),
                i       = 0,
                k       = 0;
            // Add selected class to the label.
            $('.njba-label.'+control).removeClass('selected');
            if(input.is(':checked')) {
                input.parent().addClass('selected');
                field.val(input.val());
                val = input.val();
            }
            // TOGGLE sections, fields or tabs.
            if(typeof toggle !== 'undefined') {
              toggle = JSON.parse(toggle);
              for(i in toggle) {
                GOCMBBFields._settingsFieldToggle(toggle[i].fields, 'hide', '#fl-field-');
                GOCMBBFields._settingsFieldToggle(toggle[i].sections, 'hide', '#fl-builder-settings-section-');
                GOCMBBFields._settingsFieldToggle(toggle[i].tabs, 'hide', 'a[href*=fl-builder-settings-tab-', ']');
              }
              if(typeof toggle[val] !== 'undefined') {
                GOCMBBFields._settingsFieldToggle(toggle[val].fields, 'show', '#fl-field-');
                GOCMBBFields._settingsFieldToggle(toggle[val].sections, 'show', '#fl-builder-settings-section-');
                GOCMBBFields._settingsFieldToggle(toggle[val].tabs, 'show', 'a[href*=fl-builder-settings-tab-', ']');
              }
            }
                  // HIDE sections, fields or tabs.
            if(typeof hide !== 'undefined') {
              hide = JSON.parse(hide);
              if(typeof hide[val] !== 'undefined') {
                GOCMBBFields._settingsFieldToggle(hide[val].fields, 'hide', '#fl-field-');
                GOCMBBFields._settingsFieldToggle(hide[val].sections, 'hide', '#fl-builder-settings-section-');
                GOCMBBFields._settingsFieldToggle(hide[val].tabs, 'hide', 'a[href*=fl-builder-settings-tab-', ']');
              }
            }
                  // TRIGGER select inputs.
            if(typeof trigger !== 'undefined') {
              trigger = JSON.parse(trigger);
              if(typeof trigger[val] !== 'undefined') {
                if(typeof trigger[val].fields !== 'undefined') {
                  for(i = 0; i < trigger[val].fields.length; i++) {
                    $('#fl-field-' + trigger[val].fields[i]).find('input[type="radio"]').trigger('change');
                  }
                }
              }
            }
        },
       
                /*  TOGGLE CLICK */
        _toggleExapndCollapse: function()
        {
              var   t = $(this).closest('.njba-simplify-wrapper'),
                    status = $(this).attr('njba-toggle');
                    h_value = $(this).find('.simplify_toggle');
              switch(status) {
                case 'expand':    t.find('.simplify').attr('njba-toggle', 'collapse');
                                  t.find('.njba-simplify-item.optional').hide();
                                  h_value.val('collapse');
                                  break;
                case 'collapse':  t.find('.simplify').attr('njba-toggle', 'expand');
                                  t.find('.njba-simplify-item.optional').show();
                                  h_value.val('expand');
                                  break;
                default:          t.find('.simplify').attr('njba-toggle', 'collapse');
                                  t.find('.njba-simplify-item.optional').hide();
                                  h_value.val('collapse');
                                  break;
              }
        },
        _settingsFieldToggle: function(inputArray, func, prefix, suffix)
        {
          var i = 0;
          suffix = 'undefined' == typeof suffix ? '' : suffix;
          if(typeof inputArray !== 'undefined') {
            for( ; i < inputArray.length; i++) {
              $(prefix + inputArray[i] + suffix)[func]();
            }
          }
        },
         
        /*_showHelpTooltip: function()
        {   
            var h = $(this).closest('.njba-icon, .simplify');
            h.find('.njba-tooltip').fadeIn();
        },
        
        _hideHelpTooltip: function()
        {
            var h = $(this).closest('.njba-icon, .simplify');
            h.find('.njba-tooltip').fadeOut();
        },*/
        
        _initDraggableFields: function()
        {
           var form = $( '#fl-builder-settings-section-marker' );
                //console.log(form);
            form.find('.njba-draggable-point').draggable({
                containment: "parent",
                drag: function(event, ui) {
                    var top = $(this).position().top,
                        left = $(this).position().left,
                        wd = form.find('.njba-draggable-section').width(),
                        ht = form.find('.njba-draggable-section').height(),
                        coord_value = ( ( left/wd ) * 100 ) + ',' +  ( ( top/ht ) * 100 );
                        
                    form.find('input[name=marker]').val( coord_value );
                    //console.log(coord_value);
                }
            });
        }
    };
    
    $(function(){
        GOCMBBFields._init();
    });
    
})(jQuery);
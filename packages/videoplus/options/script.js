/**
 * Video Plus theme media script
 *
 * This script is for media support to upload logo
 *
 * @category   Apptha
 * @package    videoplus
 * @version    2.1
 * @author     Apptha Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Apptha. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

window.addEvent("domready",function(){
    var tabs = [];
    var options = [];
    var opt_iterator = -1;
    var basetable = $ES('.adminform .admintable',$$('#element-box .m')[0])[2];
    $$('.paramlist_value').each(function(el){
        if(!$E('input', el) && !$E('select', el) && !$E('textarea', el)){
            opt_iterator++;
            var div_gen = new Element('div',{
                "class":"slide_top"
            });
            div_gen.innerHTML = '<span class="slidetext">'+el.innerHTML+'</span><span class="togglebtn">Toggle</span>';
            div_gen.injectBefore(basetable);
            tabs.push(div_gen);
            options[opt_iterator] = [];
        }else options[opt_iterator].push(el.getParent());
    });
    options.each(function(el,i){       
        var div = new Element('div',{
            "class":"slide_content"
        });
        div.innerHTML = '<td colspan="2"><table cellspacing="1" width="100%" class="paramlist admintable"><tbody></tbody></table></td>';
        div.injectAfter(tabs[i]);
        div_body = div.getElementsBySelector('tbody')[0];
        options[i].each(function(elm,j){
            elm.injectInside(div_body);
        });
    });
	
    var update_tab = new Element('div',{
        "class":"slide_top"
    });	
    update_tab.injectAfter($$('.slide_content').getLast());

    var toggle_slide = new Element('div',{
        "class":"slide_content"
    });	
    toggle_slide.injectAfter($$('.slide_top').getLast());
    basetable.remove();
    new Accordion($$('.slide_top'),$$('.slide_content'),{
        onActive:function(toggler){
            toggler.setProperty("class","slide_top active");
        },
        onBackground:function(toggler){
            toggler.setProperty("class","slide_top");
        },
        alwaysHide: true
    });
});
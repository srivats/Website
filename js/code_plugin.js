(function() {
	tinymce.create('tinymce.plugins.code'), {
		init : function(ed,url) {
			ed.addButton('code', {
				title : 'Code',
				inline :'code',
				image : url+'/image.png', 
				onclick : function () {
					ed.selection.setContent('[code]'+ed.selection.getContent() + '[/code]');
				}

			});
		},
		createControl : function(n,cm) {
			return null;
		},
		tinymce.PluginManager.add('code', tinymce.plugins.code);
	}
})();
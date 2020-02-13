( function( blocks, element ) {
  const { registerBlockType } = blocks;
  
  var el = element.createElement;
  var blockStyle = {
      padding: '20px',
  };
  
  registerBlockType('plgshow-wp/plg-showroom', {
      title: plgshow.title,
      description: plgshow.des,
      icon: 'screenoptions',
      className: 'wp-plugin-block',
      category: 'common',
      attributes: {
          'slug': {
              type: 'string',
            }
      },
      edit: function( props ) {
        var slug = props.attributes.slug;
        var id = 'slug';

        function updateContent( content ) {
          props.setAttributes({slug: content.target.value });
        }

        return el( "div", { className: props.className, style: blockStyle },
        el( "img", { src: plgshow.logo_plugin, resizeMethod: "scale" }),
        el( "h2", null, "Plugin Showroom" ),
        el( "div", null, null,
        el( "h4", null, null,
        el( "label", { for: id + '-control' }, plgshow.plgname))),
        el( "div", null, null,
        el( "input", { id: id + '-control', placeholder: plgshow.plgsug, className: props.className, type: "text", value: slug, onChange: updateContent }),
        ));
      },
      save: function( props ) {
          return null;
      }
    })
  }(
      window.wp.blocks,
      window.wp.element
  ) );
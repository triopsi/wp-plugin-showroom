( function( blocks, element, editor, trans) {

  const { __ } = trans;
  const { registerBlockType } = blocks;
  var RichText = editor.RichText;
  
  var el = element.createElement;
  var blockStyle = {
      backgroundColor: '#ffb0b0',
      color: '#fff',
      padding: '10px',
      textAlign: "center",
  };
  
  registerBlockType('plgshow-wp/plg-showroom', {
      title: __('Plugin-Showroom', 'plgshow'),
      description: __( 'Add a plugin showcase to your post/site.', 'plgshow' ),
      icon: 'screenoptions',
      className: 'wp-plugin-block',
      category: 'common',
      attributes: {
          'slug': {
              type: 'string',
            }
      },
      edit: function( props ) {
        var slug = props.attributes.slug
  
        function updateContent( content ) {
          // console.log(trans);
          props.setAttributes({slug: content.target.value })
        }
  
        // console.log(props);
       
        // return el(
        //     RichText,
        //     {
        //         tagName: 'input',
        //         className: props.className,
        //         onChange: updateContent,
        //         value: slug,
        //     }
        //   );
        return el( "div", { style: blockStyle },
        el( "h3", null, "Plugin Showroom" ),
        el("input", { className: props.className, type: "text", value: slug, onChange: updateContent }),
        // el(RichText,{tagName: 'div', className: props.className, onChange: updateContent, value: slug})
        );
  
        // return (
        //       <div id="block-dynamic-box">
        //           <h1>Sample dynamic PHP server-side block</h1>
        //           <p>This block will sum the numbers and render HTML on the server side</p>
        //           <label>Number 1:</label>
        //       </div>
        //   )
  
        // el( "div", { style: blockStyle },
        // el( "h3", null, "Plugin Showroom" ), 
        // el("input", { type: "text", value: props.attributes.content, onChange: updateContent }) );
      },
      save: function( props ) {
          return null;
      //   return el( "h3", { style: { border: "3px solid #000000" } }, props.attributes.content );
      }
    })
  }(
      window.wp.blocks,
      window.wp.element,
      window.wp.editor,
      window.wp.i18n
  ) );
{!! wp_nonce_field( 'ct_connection_metabox', 'ct_connection_metabox_nonce', true, false ) !!}

<div class="oxygen-connection-checkboxes-section">

    @if ($post->post_type == 'oxy_user_library')
        <div>
            <label class="post-attributes-label" for="ct_connection_page_category">Block Category</label>
            <select name="ct_connection_page_category" id="ct_connection_page_category" class="ct_connection_block_category">
                <option value="">(none)</option>
                @foreach ($categories as $item)
                    <option value="{{ $item }}" {{ $item == $category ? 'selected' : '' }}> {{$item}}</option>
                @endforeach
            </select>

            @if (!empty($category))
                <ul id="ct-connection-block-warning">
                    <li class="ct-connection-notification-error" style="margin-left: 10px">
                        Uncategorized Blocks will not be included in the library
                    </li>
                </ul>
            @endif

        </div>
    @else
        <div class="oxygen-metabox-control-group">
            <label class="connection-attributes-label" for="ct_connection_use_sections">
                <input type="checkbox" name="ct_connection_use_sections" id="ct_connection_use_sections" value='true' {{ get_post_meta($post->ID, '_ct_connection_use_sections', true)? 'checked' : '' }} />
                Include the sections in this {{ $post->post_type == 'ct_template' ? 'template' : 'page' }} in the library
            </label>
            <br />
            <label class="connection-attributes-label" for="ct_connection_use_page">
                <input type="checkbox" name="ct_connection_use_page" id="ct_connection_use_page" value='true' {{ get_post_meta($post->ID, '_ct_connection_use_page', true)? 'checked' : '' }} />
                Include this entire {{ $post->post_type == 'ct_template' ? 'template' : 'page' }} in the library
            </label>
        </div>

        @if ($post->post_type == 'page' &&  get_post_meta($post->ID, '_ct_connection_use_page', true))
            <div id="ct-connection-category">
                <label class="post-attributes-label" for="ct_connection_page_category">Page Category</label>
                <select name="ct_connection_page_category" id="ct_connection_page_category">
                    <option value="">(none)</option>
                    @foreach ($categories as $key => $item)
                        <option value="{{ $key }}" {{ $key == $category ? 'selected' : '' }}> {{ $item }}</option>
                    @endforeach
                </select>
            </div>
        @endif

    @endif


    <div class="oxygen-vsb-apply-template-label"> Screenshots </div>

    <div class="oxygen-connection-screenshots-section">
        <ul id="ct-connection-screenshot-messages">
            <li class="ct-connection-notification" style='display:none'>
                Screenshots successfully generated
            </li>

            @if (get_post_meta($post->ID, '_ct_connection_screenshots_generated', true))
                <li class="ct-connection-notification">
                    Screenshots last generated at: {{ get_post_meta($post->ID, '_ct_connection_screenshots_generated', true) }}
                </li>
            @else
                <li class="ct-connection-notification-error">
                    Warning: Screenshots never generated
                </li>
            @endif

        </ul>


        @if ($post->post_type == 'ct_template')
            <div class="oxygen-metabox-screenshot-inputs">
                <div class="oxygen-metabox-control-group">
                    <label for="ct_connection_page_screenshot">Template Screenshot</label>
                    <input type="text" name="ct_connection_page_screenshot" class="oxygen-vsb-metabox-input" id="oxygen_vsb_site_screenshot" value="{{get_post_meta($post->ID, '_ct_connection_page_screenshot', true)}}" />
                    <a href="#" id="upload_image_button" class="thickbox button">Set featured image</a>
                </div>

                <div class="oxygen-metabox-control-group">
                    <label for="ct_connection_template_screenshot_url">Specify URL to use for Template Screenshot
                    <input type="text" name="ct_connection_template_screenshot_url" class="oxygen-vsb-metabox-input" id="oxygen_vsb_screenshot_generate_url" value="{{get_post_meta($post->ID, '_ct_connection_template_screenshot_url', true)}}" /></label>
                </div>
            </div>
        @endif

        {!! wp_nonce_field( 'ct_connection_generate_screenshot', 'ct_connection_generate_screenshot_nonce', true, false ) !!}

        <p>
            <button class="button button-primary" id='oxygen-connection-generate-screenshots' disabled data-processing='Processing Screenshots...' data-postId='{{$post->ID}}'>Generate Screenshots</button>
        </p>

        <script>
            (function() {
                jQuery(document).ready(function() {
                    var fileFrame = null;
                    jQuery('#upload_image_button').on('click', function( event ){
                        event.preventDefault();
                        // Create the media frame.
                        fileFrame = wp.media.frames.fileFrame = wp.media({
                            title: 'Select an image to upload',
                            button: {
                                text: 'Use this image',
                            },
                            multiple: false	
                        });
                        fileFrame.on( 'select', function() {
                            attachment = fileFrame.state().get('selection').first().toJSON();
                            console.log(attachment);
                            console.log($( '#oxygen_vsb_site_screenshot' ));
                            $( '#oxygen_vsb_site_screenshot' ).val( attachment.url );

                        });
                        fileFrame.open();
                    });
                })
            })()
        </script>
    </div>
</div>
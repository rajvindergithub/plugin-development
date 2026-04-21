 <style>
     .card {
         max-width: 100% !important;
     }

     .wcp_custom_plugin {
         --bg: #0b1020;
         --card: #121933;
         --muted: #8ea0c2;
         --text: #e9eefc;
         --accent: #4f7cff;
         --accent-2: #22c55e;
         --danger: #ef4444;
         --ring: #93c5fd55;
         --border: #243357;
         --shadow: 0 10px 30px rgba(0, 0, 0, .35);
         --radius: 16px;
         --space: 14px;

         font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
         background: radial-gradient(1200px 800px at 10% 10%, #0f1733, var(--bg));
         color: var(--text);
         min-height: 100vh;
         display: flex;
         align-items: center;
         justify-content: center;
         padding: 32px 16px;
     }

     .wcp_custom_plugin .wrapper {
         width: 100%;
         max-width: 100%;
     }

     .wcp_custom_plugin .card {
         background: linear-gradient(180deg, #101736, #0f1530 60%);
         border: 1px solid var(--border);
         border-radius: var(--radius);
         box-shadow: var(--shadow);
         overflow: hidden;
     }

     .wcp_custom_plugin .header {
         padding: 22px 24px;
         border-bottom: 1px solid var(--border);
         display: flex;
         align-items: center;
         justify-content: space-between;
         gap: 12px;
         background:
             radial-gradient(600px 120px at 0% 0%, #18265a44, transparent 60%),
             linear-gradient(180deg, #111a3d, #0f1530);
     }

     .wcp_custom_plugin .header h1 {
         font-size: clamp(18px, 2vw, 22px);
         margin: 0;
         letter-spacing: .2px;
     }

     .wcp_custom_plugin .header p {
         margin: 0;
         color: var(--muted);
         font-size: 14px;
     }

     .wcp_custom_plugin form {
         padding: 20px;
     }

     .wcp_custom_plugin .grid {
         display: grid;
         grid-template-columns: 1.2fr 1fr;
         gap: 20px;
     }

     @media (max-width: 860px) {
         .wcp_custom_plugin .grid {
             grid-template-columns: 1fr;
         }
     }

     .wcp_custom_plugin .section {
         background: #0e1530aa;
         border: 1px solid var(--border);
         border-radius: 14px;
         padding: 16px;
     }

     .wcp_custom_plugin .section h2 {
         margin: 0 0 12px 0;
         font-size: 16px;
         color: #c9d7ff;
         font-weight: 600;
     }

     .wcp_custom_plugin .field {
         display: flex;
         flex-direction: column;
         gap: 8px;
         margin-bottom: 14px;
     }

     .wcp_custom_plugin .field.inline {
         display: grid;
         grid-template-columns: 1fr 1fr;
         gap: 12px;
     }

     .wcp_custom_plugin label {
         font-size: 14px;
         color: #c9d7ff;
     }

     .wcp_custom_plugin .hint {
         font-size: 12px;
         color: var(--muted);
     }

     .wcp_custom_plugin input[type="text"],
     .wcp_custom_plugin input[type="number"],
     .wcp_custom_plugin textarea {
         width: 100%;
         padding: 12px 12px;
         font-size: 15px;
         color: var(--text);
         background: #0b1330;
         border: 1px solid #213057;
         border-radius: 10px;
         outline: none;
     }

     .wcp_custom_plugin input::placeholder,
     .wcp_custom_plugin textarea::placeholder {
         color: #6f84ad;
     }

     .wcp_custom_plugin textarea {
         min-height: 110px;
         resize: vertical;
     }

     .wcp_custom_plugin .img-uploader {
         display: grid;
         grid-template-columns: 120px 1fr;
         gap: 14px;
         align-items: start;
     }

     @media (max-width: 520px) {
         .wcp_custom_plugin .img-uploader {
             grid-template-columns: 1fr;
         }
     }

     .wcp_custom_plugin .preview {
         width: 120px;
         aspect-ratio: 1/1;
         border-radius: 12px;
         border: 1px dashed #2a3a67;
         display: flex;
         align-items: center;
         justify-content: center;
         overflow: hidden;
         background: #0b1330;
         position: relative;
         color: var(--muted);
         font-size: 12px;
         text-align: center;
         padding: 8px;
     }

     .wcp_custom_plugin .file-row {
         display: flex;
         gap: 10px;
         align-items: center;
         flex-wrap: wrap;
     }

     .wcp_custom_plugin .file-row input[type="file"] {
         padding: 10px;
         background: #0b1330;
         border: 1px dashed #2a3a67;
         border-radius: 10px;
         color: var(--muted);
         cursor: pointer;
     }

     .wcp_custom_plugin .actions {
         display: flex;
         justify-content: flex-end;
         gap: 10px;
         padding: 16px 20px 22px;
         border-top: 1px solid var(--border);
         background: #0f1530;
     }

     .wcp_custom_plugin button {
         appearance: none;
         border: 1px solid transparent;
         padding: 10px 16px;
         border-radius: 12px;
         font-size: 15px;
         font-weight: 600;
         cursor: pointer;
         transition: background .2s ease;
     }

     .wcp_custom_plugin .btn-secondary {
         background: transparent;
         border-color: #2a3a67;
         color: #c9d7ff;
     }

     .wcp_custom_plugin .btn-secondary:hover {
         background: #0b1330;
     }

     .wcp_custom_plugin .btn-primary {
         background: linear-gradient(180deg, #5a86ff, #3e6bff);
         color: white;
     }

     .wcp_custom_plugin .badge {
         display: inline-block;
         padding: 2px 8px;
         border-radius: 999px;
         background: #12306b;
         border: 1px solid #254181;
         color: #cfe0ff;
         font-size: 12px;
         margin-left: 8px;
     }

     .wcp_custom_plugin .small {
         font-size: 12px;
         color: var(--muted);
     }

 </style>


 <div class="wcp_custom_plugin" style="width: 100% !important; ">
     <div class="wrapper">
         <div class="card">
             <div class="header">
                 <div>
                     <h1>New Product</h1>
                     <p>Fill in the details below to create a product.</p>
                 </div>
                 <span class="badge">Draft</span>
             </div>

             <form action="" method="post" enctype="multipart/form-data">

                 <?php wp_nonce_field("wcp_handle_add_product_form_submit","wcp_nonce_value")?>

                 <div class="grid">
                     <!-- Left column -->
                     <div class="section">
                         <h2>Basic Info</h2>

                         <div class="field">
                             <label for="name">Name</label>
                             <input id="name" name="wcp_name" type="text" placeholder="e.g., UltraSoft Hoodie" required />
                         </div>

                         <div class="field inline">
                             <div>
                                 <label for="regular_price">Regular Price (₹)</label>
                                 <input id="regular_price" name="wcp_regular_price" type="number" step="0.01" min="0" placeholder="0.00" required />
                             </div>
                             <div>
                                 <label for="sale_price">Sale Price (₹)</label>
                                 <input id="sale_price" name="wcp_sale_price" type="number" step="0.01" min="0" placeholder="0.00" />
                             </div>
                         </div>

                         <div class="field">
                             <label for="sku">SKU</label>
                             <input id="sku" name="wcp_sku" type="text" placeholder="e.g., HOOD-ULTRA-NA-001" required />
                         </div>

                         <div class="field">
                             <label for="short_description">Short Description</label>
                             <textarea id="short_description" name="wcp_short_description" placeholder="One-liner summary"></textarea>
                         </div>

                         <div class="field">
                             <label for="description">Description</label>
                             <textarea id="description" name="wcp_description" placeholder="Full product details"></textarea>
                         </div>
                     </div>

                     <!-- Right column -->
                     <div class="section">
                         <h2>Product Image</h2>

                         <div class="img-uploader">
                             
                             <div>
                                 <div class="field">
                                    <label for="product_image">Upload Product Image</label>
                                    <button type="button" id="btn_upload_product_image">
                                         Upload Product Image
                                    </button>
                                     
                                     <input type="hidden" name="product_media_id" id="product_media_id" value="" />
                                     
                                     <img src="http://localhost/plugin-development/wp-content/uploads/2025/08/logo-icon.png" id="product_image_upload_wc" style="height: 100px; width: 100px; " />
                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>

                 <div class="actions">
                     <!--          <button type="reset" class="btn-secondary">Reset</button>-->
                     <button type="submit" class="btn-primary" name="btn_submit_woocom_product">Save Product</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

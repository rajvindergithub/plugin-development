<h2>
    Form Data
</h2>

<style type="text/css">
    .fields_form label{ width: 100%; display: block; font-weight: 600; font-size: 1.25rem; margin-bottom: 1rem; color: brown; }
</style>

<form action="javascript:void(0);" id="frm-csv-upload" enctype="multipart/form-data">
    <p class="fields_form">
        <label for="csv_data_file">Upload CSV File</label>
        <input type="file" name="csv_data_file" id="csv_data_file" />
        <input type="hidden" name="action" value="cdu_submit_form_data" />
    </p>
    <p class="fields_form">
        <button type="submit">Upload CSV</button>
    </p>
</form>
<div id="result_upload_csv"></div>
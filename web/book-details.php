<form name="frmAdd" method="post" action="" id="frmBook"
    onSubmit="event.preventDefault(); return validate();">
    <input type="hidden"
            name="id" id="id" value="0">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Book Name</label> <span
            id="b_name-info" class="info"></span><br /> <input type="text"
            name="b_name" id="b_name" class="demoInputBox">
    </div>
    <div>
        <label>Author Name</label> <span id="a_name-info"
            class="info"></span><br /> <input type="text"
            name="a_name" id="a_name" class="demoInputBox">
    </div>
    <div style="float: left;padding:1px;">
        <input type="button" name="submit" id="btnSubmit" class = "btnSubmit" value="Submit" />
    </div>
    <div>
        <input type="button" name="cancel" id="btnCancel" class = "btnSubmit" value="Cancel" />
    </div>
    </div>
</form>
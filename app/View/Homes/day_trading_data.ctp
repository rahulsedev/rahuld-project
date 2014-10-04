<!-- start top_bg -->
<div class="top_bg" style="background-image: url('<?php echo $this->webroot . 'img/banner/' . $data['Banner']['image'] ?>');">
	<div class="wrap">
		<div class="top">
			<h2><?php echo __($data['CmsPage']['title']); ?></h2>
		</div>
	</div>
</div>
<!-- start main -->
<div class="wrap">
<div class="main">
		<div class="about">
	    	<div class="about-p">
				<?php echo __($data['CmsPage']['content']); ?>
			</div>
			<table width="100%" cellspacing="3" cellpadding="3">
				<tr>
					<td>
						<div id="DT1" style="width: 402px; height: 346px"></div>
					</td>
					<td>
						<div id="DT2" style="width: 402px; height: 346px"></div>
					</td>
					<td>
						<div id="DT3" style="width: 402px; height: 346px"></div>
					</td>
				</tr>
			</table>
		</div>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript" src="http://r.office.microsoft.com/r/rlidExcelWLJS?v=1&kip=1"></script>
<script type="text/javascript">
	/*
	 * This code uses the Microsoft Office Excel Javascript object model to programmatically insert the
	 * Excel Web App into a div with id=myExcelDiv. The full API is documented at
	 * http://msdn.microsoft.com/en-US/library/hh315812.aspx. There you can find out how to programmatically get
	 * values from your Excel file and how to use the rest of the object model. 
	 */

	// Use this file token to reference DTPTDat.xlsx in Excel's APIs
	var fileToken = "SD86DF13CAE12382AA!222/-8728235790739209558/t=0&s=0&v=!AMvdLtwjeqkfKts";

	// run the Excel load handler on page load
	if (window.attachEvent) {
		window.attachEvent("onload", loadEwaOnPageLoad);
	} else {
		window.addEventListener("DOMContentLoaded", loadEwaOnPageLoad, false);
	}

	function loadEwaOnPageLoad() {
		var props = {
			uiOptions: {
				showDownloadButton: false,
				showParametersTaskPane: false
			},
			interactivityOptions: {
				allowTypingAndFormulaEntry: false,
				allowParameterModification: false,
				allowSorting: false,
				allowFiltering: false,
				allowPivotTableInteractivity: false
			}
		};

		Ewa.EwaControl.loadEwaAsync(fileToken, "DT1", props, onEwaLoaded);
	}

	function onEwaLoaded(result) {
		/*
		 * Add code here to interact with the embedded Excel web app.
		 * Find out more at http://msdn.microsoft.com/en-US/library/hh315812.aspx.
		 */
	}
</script>

<script type="text/javascript">
	/*
	 * This code uses the Microsoft Office Excel Javascript object model to programmatically insert the
	 * Excel Web App into a div with id=myExcelDiv. The full API is documented at
	 * http://msdn.microsoft.com/en-US/library/hh315812.aspx. There you can find out how to programmatically get
	 * values from your Excel file and how to use the rest of the object model. 
	 */

	// Use this file token to reference DTRTDat1.xlsx in Excel's APIs
	var fileToken = "SD86DF13CAE12382AA!221/-8728235790739209558/t=0&s=0&v=!AHOndTLzXfOjoS8";

	// run the Excel load handler on page load
	if (window.attachEvent) {
		window.attachEvent("onload", loadEwaOnPageLoad);
	} else {
		window.addEventListener("DOMContentLoaded", loadEwaOnPageLoad, false);
	}

	function loadEwaOnPageLoad() {
		var props = {
			uiOptions: {
				showDownloadButton: false,
				showParametersTaskPane: false
			},
			interactivityOptions: {
				allowTypingAndFormulaEntry: false,
				allowParameterModification: false,
				allowSorting: false,
				allowFiltering: false,
				allowPivotTableInteractivity: false
			}
		};

		Ewa.EwaControl.loadEwaAsync(fileToken, "DT2", props, onEwaLoaded);
	}

	function onEwaLoaded(result) {
		/*
		 * Add code here to interact with the embedded Excel web app.
		 * Find out more at http://msdn.microsoft.com/en-US/library/hh315812.aspx.
		 */
	}
</script>

<script type="text/javascript">
	/*
	 * This code uses the Microsoft Office Excel Javascript object model to programmatically insert the
	 * Excel Web App into a div with id=myExcelDiv. The full API is documented at
	 * http://msdn.microsoft.com/en-US/library/hh315812.aspx. There you can find out how to programmatically get
	 * values from your Excel file and how to use the rest of the object model. 
	 */

	// Use this file token to reference DTRTDat2.xlsx in Excel's APIs
	var fileToken = "SD86DF13CAE12382AA!225/-8728235790739209558/t=0&s=0&v=!AF7DurkTPZc9_eA";

	// run the Excel load handler on page load
	if (window.attachEvent) {
		window.attachEvent("onload", loadEwaOnPageLoad);
	} else {
		window.addEventListener("DOMContentLoaded", loadEwaOnPageLoad, false);
	}

	function loadEwaOnPageLoad() {
		var props = {
			uiOptions: {
				showDownloadButton: false,
				showParametersTaskPane: false
			},
			interactivityOptions: {
				allowTypingAndFormulaEntry: false,
				allowParameterModification: false,
				allowSorting: false,
				allowFiltering: false,
				allowPivotTableInteractivity: false
			}
		};

		Ewa.EwaControl.loadEwaAsync(fileToken, "DT3", props, onEwaLoaded);
	}

	function onEwaLoaded(result) {
		/*
		 * Add code here to interact with the embedded Excel web app.
		 * Find out more at http://msdn.microsoft.com/en-US/library/hh315812.aspx.
		 */
	}
</script>
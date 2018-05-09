<form class="justify-content-center" id="form">
    <fieldset>

        <!-- Form Name -->
        <legend style="text-align: center;"><h1>Search Content</h1></legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="content">Content :</label>  
            <div class="col-md-4">
                <input id="contentTitle" name="contentTitle" type="text" placeholder="Input Text" class="form-control input-md">
            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="category">Category:</label>
          <div class="col-md-4">
            <select id="category" name="category" class="form-control">
              <option value="">Select One</option>
              <?=displayCategories()?>
            </select>
          </div>
        </div>

        <!-- Multiple Radios -->
        <div class="form-group">
          <label class="col-md-5 control-label" for="orderBy">Order Results By:</label>
          <div class="col-md-4">
          <div class="radio">
            <label for="orderBy-0">
              <input type="radio" name="orderBy" id="author" value="author" checked="checked">
              Author
            </label>
        	</div>
          <div class="radio">
            <label for="orderBy-1">
              <input type="radio" name="orderBy" id="nameD" value="nameD">
              Name (<i class="fas fa-sort-alpha-up"></i>)
            </label>
        	</div>
        	<div class="radio">
            <label for="orderBy-2">
              <input type="radio" name="orderBy" id="nameA" value="nameA">
              Name (<i class="fas fa-sort-alpha-down"></i>)
            </label>
        	</div>
        	<div class="radio">
            <label for="orderBy-3">
              <input type="radio" name="orderBy" id="date" value="date">
             Date
            </label>
        	</div>
          </div>
        </div>
        <!--<div class="form-group">
            <input type="submit" value="Search" class="col-md-12 btn btn-success" name="searchForm" />
        </div>-->
    </fieldset>
    <h3>Result</h3>
</form>
<br />
<hr>
<div id="container">
<table align="center">
  <tbody>
  <tr>
    <td class="header_top">
      <table>
        <tbody>
        <tr>
          <td height="194" width="100%"><!--<img src="images/logo1.png" width="150" height="90"/>--><img 
            src="images/logo.jpg"   width="480" "height=94"></td>
          <td vAlign="top" width="48%" >
            <table border="0" cellSpacing="0" cellPadding="0" width="100%">
              <tbody>
              <tr>
            
				<td height="15" vAlign="top" align="right" style="padding-right:20px; ">
                <?php
		        if(isset($_SESSION["user"]))
		        {
	            ?>
                <a href="logout.php">Log Out</a>&nbsp;&nbsp;
                <?php
				}
				?>
                <a href="sign_up.php">Sign Up
              </font></a> </font>
				</td>
              </tr>
			  
              <tr>
                <td align="right" style="padding-top:35px; padding-right:30px; font-size:12px; width:100%">
				
				<form action="std_login_submit.php" method="post">
          <fieldset style="width:360px; ">
            <legend>Student Login</legend>
			<br>
			
            <label for="pupilname">Email:
              <input type="text" name="pupilname" id="pupilname" value="" style=" height:15px; width:150px"/> 
              
            </label>
			
            <label for="pupilpass">Password:
              <input type="password" name="pupilpass" id="pupilpass" value="" style="width:90px; height:15px;" />
            </label>
			<br><br>
            <label for="pupilremember">
              <input class="checkbox" type="checkbox" name="pupilremember" id="pupilremember" checked="checked" />
              Remember me</label>
            &nbsp;&nbsp;&nbsp;&nbsp;
              <input type="button" name="pupillogin" id="pupillogin" value="Go" style=" font-size:12px; " onClick="checking_accout(pupilname.value,pupilpass.value)"/>
              &nbsp;
              <input type="reset" name="pupilreset" id="pupilreset" style=" font-size:12px; "  value="Reset" />
            
			</fieldset>
        </form>
				
				</td></tr>

			 </tbody></table></td></tr></tbody></table></td>
	</tr>
  <tr>
    <td>
			<?php
				require('include/common/menu.php');
			?>
	</td>
	</tr>
  <tr>
    <td height="20">&nbsp;</td></tr>
  <tr>
    <td class="banner" vAlign="top" align="right">
	<a href="requestquote.asp"><img name="a" src="images/spacer.png" width="232" height="132" alt=""></a>
      <form id="form1" method="post" name="form1" action="">
      <table border="0" cellSpacing="0" cellPadding="0" width="280">
        <tbody>
        <tr>
          <td width="37">&nbsp;</td>
          <td width="212">&nbsp;</td>
          <td width="31">&nbsp;</td></tr>
		  <tr>
          <td height="15" colSpan="3"></td>
          <td height="7" colSpan="3"></td></tr>
        <tr>
		<tr>
          <td height="15" colSpan="3"></td></tr>
          <td height="7" colSpan="3"></td></tr>
        <tr>
        <tr>
         <td>&nbsp;</td>
          <td  align="LEFT" class="phone1"></td>
          <td class="phone">&nbsp;</td></tr>
        <tr>
          <td height="15" colSpan="3"></td></tr>
          <td height="7" colSpan="3"></td></tr>
        <tr>
          <td>&nbsp;</td>
          <td align="right" class="phone1"></td>
          <td>&nbsp;</td></tr>
		  </tbody></table></FORM></td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td></tr>
  <tr>
    <td>
      <table border="0" cellSpacing="0" cellPadding="0" width="950">
        <tbody>
        <tr>
          <td vAlign="top" width="702">
		  
	<?php
		if(isset($_SESSION['users']))
		{
	   ?>
		  
		  
            <table border="0" cellSpacing="0" cellPadding="0" width="100%">
              <tbody>
              <tr>
			  
			  <!--  Vertical column starts here -->
			  
			  	<!-- First Vertical Column -->
                <td style="border:0px solid red ">
				
				<table><tbody><tr>
				
				<td  width="230px" valign="top" style="border:0px solid yellow ">
                 
					
					
					<!-- First Column Ends -->
					<td width="8px"></td>
					<td width="233px" valign="top" style=" border:0px solid blue; ">
					
					<!--2nd Vertical Column starts-->

					
	
					
					<!--2nd vertical column ends-->
					
					</td>
					<td width="8px"></td>
					<td width="223px" valign="top" style="border:0px solid green; ">
					
					
					<!--Third Vertical Column starts-->
					 
					
					<!--Third vertical column ends-->
					
					
					</td>
					
					
					</td></tr></tbody></table>
					
					</td>
					
					
					
					</tr>
              <tr>
                <td height="7"></td></tr>
              <tr>
                <td>
                  
				 
				  </td></tr>
              <tr>
                <td height="7"></td></tr>
              <tr>
                <td>
                 
				
				 </td></tr>
              <tr>
                <td height="7"></td></tr>
              <tr>
                <td>
				
			
					
					
					
					</td></tr></tbody></table>
					
					
					
					
		<!-- Here the guest user interface ends-->			
		<?php
			}
				if(isset($_SESSION['users']))
			{
			
		?>
		
		
		<!-- Member user section starts-->
		
		
		<div class="fl_left">
   <div class="column2">
    <div id="content" > 
    <div class="contentbox"> 
    <div class="box box_first" id="box_math">
	<div class="box_header" >
	<a>
	<span class="larger"><?php echo $chapters[0][1];?></span>
	<div class="large">List Of Cources &raquo;</div>
	</a>
   <div class="box_over">
      <div class="dim"></div>
      <div class="borderTop"></div>
      <div class="scrollTop" onMouseOver="scrollContent(this,-1)" onMouseOut="cancelScroll(this)"></div>
      <div class="scrollBot" onMouseOver="scrollContent(this,1)" onMouseOut="cancelScroll(this)"></div>
      <div class="box_course hover_red">
         <ul>
         <?php
		while($row_math=mysql_fetch_array($math_result))
			{
		?>
         <li><a href="teacher.php?t_id=<?php echo $row_math["teacher_id"];?>&c_id=<?php echo $row_math["s_subject_id"];?>"><?php echo $row_math["sub_subject_name"];?> </a></li>
           <?php
		  
			}
            ?>
         </ul></div></div>	</div><!-- box_header -->
	<div class="box_body" >
	<div class="box_img">
    
    Select From Above list
    <br/><br/>
	<a href="#" ><img src="images/mathclass.gif" border="0" height="110px" ></a>
	</div><!-- box_img -->
	<div class="box_text" >
	<div style=" margin-top:20px">
	<u>Dr.Doolat Ram</u> 
    Instructs Minamath's Linear ALgebra course. Experts in linier equation and demographic charts. Supervises the many course projects.
	</div>
	<div style=" margin-top:10px">
    <a href="#" class="bold">Free Lecture</a><br>
	<a href="#">Geometry</a>&nbsp;&nbsp;&nbsp;
	<a href="#">Numerical Analysis</a>
        </div>
		</div><!-- box_text -->
    
	</div><!-- box_body -->
   
	</div><!-- box_math -->
	<div>
 
</div>

</div>
	<!-- Mathematics Ends-->
    
    <div class="contentbox"> 
	<div class="box" id="box_chem">
	<div class="box_header"><a>
	<span class="larger"><?php echo $chapters[1][1];?></span>
	<div class="large">List Of Cources &raquo;</div>
	</a>
   <div class="box_over">
      <div class="dim"></div>
      <div class="borderTop"></div>
      <div class="scrollTop" onMouseOver="scrollContent(this,-1)" onMouseOut="cancelScroll(this)"></div>
      <div class="scrollBot" onMouseOver="scrollContent(this,1)" onMouseOut="cancelScroll(this)"></div>
      <div class="box_course hover_red">
         <ul>
          <?php
         while($row_chem=mysql_fetch_array($chem_result))
         {
		 ?>
         <li><a href="teacher.php?t_id=<?php echo $row_chem["teacher_id"];?>&c_id=<?php echo $row_chem["s_subject_id"];?>"><?php echo $row_chem["sub_subject_name"];?></a></li>
         <?php
		 }
		 ?>
         </ul></div></div>   </div><!-- box_header -->
	<div class="box_body">
	<div class="box_img">
    Select From Above list
    <br/><br/>
	<a href="#" title="Chemistry"><img src="images/chemistryclass.gif" height="110px" width="80px"></a>
	</div><!-- box_img -->
	<div class="box_text">
	 <div style=" margin-top:20px">
	<u>Dr. Rashid ali</u>
 
     Guides you through Minamath's Chemistry course. Equations, balancing, its practical demonstration; project supervision and labs.
	  <div style=" margin-top:10px">
    <a href="#" class="bold">Free Lecture</a><br>
	<a href="#">Geometry</a>&nbsp;&nbsp;&nbsp;
	<a href="#">Numerical Analysis</a>

    </div>
   
    
   
	</div><!-- box_text -->
	</div><!-- box_body -->
	</div><!-- box_chem -->
    <div>
  
    </div>
	</div>	
   
 
       <!--chemistry ends -->
   
</div><!--left ends-->
</div><!--col2 ends-->
</div><!--contents ends-->


  <div class="fl_left">
      
      <div class="column2">
    	<div id="content" >  	
    <!--physics -->
    
    <div class="contentbox"> 
	<div class="box" id="box_phys">
	<div class="box_header"><a>
	<span class="larger"><?php echo $chapters[2][1];?></span>
	<div class="large">List Of Cources &raquo;</div>
	</a>
   <div class="box_over">
      <div class="dim"></div>
      <div class="borderTop"></div>
      <div class="scrollTop" onMouseOver="scrollContent(this,-1)" onMouseOut="cancelScroll(this)"></div>
      <div class="scrollBot" onMouseOver="scrollContent(this,1)" onMouseOut="cancelScroll(this)"></div>
      <div class="box_course hover_red">
         <ul> 
		 <?php
		while($row_phys=mysql_fetch_array($phys_result))
		{
		  ?>
            <li><a href="teacher.php?t_id=<?php echo $row_phys["teacher_id"];?>&c_id=<?php echo $row_phys["s_subject_id"];?>"><?php echo $row_phys["sub_subject_name"];?> </a></li>
         <?php
		  
		}
        ?>
         </ul></div></div>   </div><!-- box_header -->
	<div class="box_body">
	<div class="box_img">
    Select From Above List
    <br/>
    <br/>
	<a href=""><img src="images/physicsclass.gif" height="110px" width="80px" ></a>
	</div><!-- box_img -->
	<div class="box_text">
	<div style=" margin-top:20px">
	<u>Dr. Jameel Ahmed </u>
    
    Teach you Physics  from 
Electric to Magnetics, Waves, Sound. Project supervising and emperical analysis.
    </div>
      <div style=" margin-top:10px">
    <a href="#" class="bold">Free Lecture</a><br>
	<a href="#">Geometry</a>&nbsp;&nbsp;&nbsp;
	<a href="#">Numerical Analysis</a>

   </div>
	</div><!-- box_text -->
	</div><!-- box_body -->
    </div><!-- box_phys -->
    <div><!--2bd div-->

    </div><!--2bd div-->
	</div><!--Outer div-->
    
    
    
    <!-- Biology -->
    <div class="contentbox"> 
	<div class="box" id="box_biol">
	<div class="box_header"><a>
	<span class="larger"><?php echo $chapters[3][1];?></span>
	<div class="large">List Of Cources &raquo;</div>
	</a>
   <div class="box_over">
      <div class="dim"></div>
      <div class="borderTop"></div>
      <div class="scrollTop" onMouseOver="scrollContent(this,-1)" onMouseOut="cancelScroll(this)"></div>
      <div class="scrollBot" onMouseOver="scrollContent(this,1)" onMouseOut="cancelScroll(this)"></div>
      <div class="box_course hover_red">
         <ul>
          <?php
		while($row_bio=mysql_fetch_array($bio_result))
		{
		  ?>
            <li><a href="teacher.php?t_id=<?php echo $row_bio["teacher_id"];?>&c_id=<?php echo $row_bio["s_subject_id"];?>"><?php echo $row_bio["sub_subject_name"];?> </a></li>
         <?php
		  
	    }
		 ?>
         </ul>
         </div></div>   </div><!-- box_header -->
	<div class="box_body">
	<div class="box_img">
    Select From above list
    <br />
    <br />
	<a href="#" title="Biology"><img src="images/biologyclass.gif" height="110px"></a>
	</div><!-- box_img -->
	<div class="box_text">
        <div style=" margin-top:20px">

	<u>Mr Farhan Khan</u>
     
      Guide you from basic concept of Biology 
     to Advance. He is expert in the field of biology and microbiology, vast knowledge.
	 </div>
      <div style=" margin-top:10px">
    <a href="#" class="bold">Free Lecture</a><br>
		
	<a href="#">Geometry</a>&nbsp;&nbsp;&nbsp;<a href="#">Numerical Analysis</a>

    </div>
	</div><!-- box_text -->
	</div><!-- box_body -->
	</div><!-- box_biol -->
   
    <div> <!-- 2nd div-->

    
    </div>
    
	</div> <!--Outer div -->
</div><!--left ends-->
</div><!--col2 ends-->
</div><!--contents ends-->


    
  <div class="fl_left">
      
      <div class="column2">
    	<div id="content" >  
   <!-- Computer -->
    <div class="contentbox">  
	<div class="box box_last" id="box_comp">
	<div class="box_header"><a>
	<span class="larger"><?php echo $chapters[4][1];?></span>
	<div class="large">List Of Cources &raquo;</div>
	</a>
   <div class="box_over">
      <div class="dim"></div>
      <div class="borderTop"></div>
      <div class="scrollTop" onMouseOver="scrollContent(this,-1)" onMouseOut="cancelScroll(this)"></div>
      <div class="scrollBot" onMouseOver="scrollContent(this,1)" onMouseOut="cancelScroll(this)"></div>
      <div class="box_course hover_red">
         <ul>           
         <?php
		while($row_comp=mysql_fetch_array($comp_result))
		{
		  ?>
            <li><a href="teacher.php?t_id=<?php echo $row_comp["teacher_id"];?>&c_id=<?php echo $row_comp["s_subject_id"];?>"><?php echo $row_comp["sub_subject_name"];?> </a></li>
         <?php
		  
	   }
		 ?>

         </ul></div></div>   </div><!-- box_header -->
	<div class="box_body">
	<div class="box_img">
        Select From above list
    <br />
    <br />
	<a href="#" title="Html training"><img src="images/computerclass.gif" width="128" height="104" alt="Computer Science"></a>
	</div><!-- box_img -->
	<div class="box_text">
	  <div style=" margin-top:10px">

	<u>Dr.Ghafor Memon</u>
    He has an extensive experice of softwate development and have been teaching many different computer science subjects for years in IMCS University of Sindh
      </div>
      <div style=" margin-top:10px">
    <a href="#" class="bold">Free Lecture</a><br>
		
	<a href="#">Geometry</a>&nbsp;&nbsp;&nbsp;<a href="#">Numerical Analysis</a>

    </div>
 
	</div><!-- box_text -->
	</div><!-- box_body -->

	</div><!-- box_comp -->
<div><!--2nd div-->

 </div>
</div>


</div><!--Outer div -->
	
	</div><!-- content -->

       <?php
         }
         ?>         
     </div>
    </div>
        <br class="clear" />
 
		
		
		
		<!-- Member user section ends-->
		
		  </td>
          <td>&nbsp;</td>
          <td vAlign=top width="240px" style="padding-left:2px; border:0px solid yellow; ">
		  
		  <!--Online student center - right nav-->
		 
		<!--   old right nav -->
            <table border=0 cellSpacing=0 cellPadding=0 width="100%">
              <tbody>
              <tr>
                <td style="padding-top:2px; ">
                  <table class=bxborder border=0 cellSpacing=0 cellPadding=0 
                  width="100%"> 
                    <tbody>
                    <tr>
                      
                      <td class="boxst" height=40 style="padding-left:5px; padding-top:10px; " align=left><SPAN 
                        class="txt1 style1"><StrONG>Online Student Center
						
						</StrONG></SPAN></td></tr>
                    <tr>
                      <td height="430" style="padding-left:5px; padding-top:10px; " valign="top"  align=left>
					  <ul style="padding-left:15px; "><li><strong>
         Most Comphrensive Courses of Mathematics and Science Of Internet.</strong></li><br />

             <li><strong>Unlimited Access to All Courses.</strong></li><br />

          <li><strong>Easy to Browse to your Subject.</strong></li><br />

          <li><strong>Latest Technology on Lecture Presentation White Board.</strong></li><br />

          <li><strong>Online Subscription</strong></li>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monthly Plan:$<br>
                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yearly Plan$<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Group And School Plan<br>
          </ul>
         <br>
		  <ul style="padding-left:15px; ">
		  <li><b> Quick Link</b></li>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Free Sample Lectures<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FAQ<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ready To Join<br></ul>
				<br><br>
<p><select name="plan">
<option value="">Monthly Plan $</option>
<option value="">Yearly Plan $</option>
<option value="">Group/School Plan</option>
</select></p>



       </td>
                    </tr></tbody></table></td></tr>
              <tr>
                <td height=7></td></tr></tbody></table>
			
				<!--table old ends-->
			
				
				
			  </td></tr></tbody></table>
				
		
	  </td></tr>
  <tr>
    <td></td></tr></tbody></table>
	<br />
<br />
<br />

      <!--<table border="0| cellSpacing=0 cellPadding=0 style="border-top:2px solid #cccccc; background-color:#e1e1e1; " width="100%">-->
	  <table  style="border-top:2px solid #cccccc; background-color:#e1e1e1;"  width="100%">
        <tbody>
        <tr>
			<td>
				<table style="width:950px;text-align:left;text-style:justify;"> 
					<tbody>
						<tr>
							<?php
							
								for($i = 0;$i<count($chapters);$i++){
							?>
							
							<td style="PADDING-LEFT: 8px" class="foot" height="35"  width="528">
								<a href="index.php?ch=<?php echo $chapters[$i][0];?>"><?php echo $chapters[$i][1];?></a></td>
							<td rowSpan=2 width=60 align=middle><img src="images/foot_line.jpg"  width="1" height="144"></td>
							
							<?php
							}
							?>
         </tr>
        <tr valign="top">
        	
		
          <?php
			$math_result=mysql_query("SELECT * FROM topic WHERE ch_id = 1");
			$math_result2=mysql_query("SELECT * FROM topic WHERE ch_id = 2");
			$math_result3=mysql_query("SELECT * FROM topic WHERE ch_id = 3");
			$math_result4=mysql_query("SELECT * FROM topic WHERE ch_id = 4");
			$math_result5=mysql_query("SELECT * FROM topic WHERE ch_id = 5");
		?>
		<td>
		<?php
		  while($math_sub=mysql_fetch_array($math_result))
		  {
			
		
			
		  ?>
            &nbsp; &nbsp; &nbsp; &nbsp;<b>.</b> <a href="#" style="text-decoration:none"><?php echo $math_sub[1];?></a><br />

		 
		<?php
		}
		   ?>
        </td>
				<td>
		<?php
		  while($math_sub=mysql_fetch_array($math_result2))
		  {
			
		
			
		  ?>
            &nbsp; &nbsp; &nbsp; &nbsp;<b>.</b> <a href="#" style="text-decoration:none"><?php echo $math_sub[1];?></a><br />

		 
		<?php
		}
		   ?>
        </td>
		<td>
		<?php
		  while($math_sub=mysql_fetch_array($math_result3))
		  {
			
		
			
		  ?>
            &nbsp; &nbsp; &nbsp; &nbsp;<b>.</b> <a href="#" style="text-decoration:none"><?php echo $math_sub[1];?></a><br />

		 
		<?php
		}
		   ?>
        </td>
		<td>
		<?php
		  while($math_sub=mysql_fetch_array($math_result4))
		  {
			
		
			
		  ?>
            &nbsp; &nbsp; &nbsp; &nbsp;<b>.</b> <a href="#" style="text-decoration:none"><?php echo $math_sub[1];?></a><br />

		 
		<?php
		}
		   ?>
        </td>
		<td>
		<?php
		  while($math_sub=mysql_fetch_array($math_result5))
		  {
			
		
			
		  ?>
            &nbsp; &nbsp; &nbsp; &nbsp;<b>.</b> <a href="#" style="text-decoration:none"><?php echo $math_sub[1];?></a><br />

		 
		<?php
		}
		   ?>
        </td>		
		
				</tr>
				<tr><td colspan="10">
      
                    <table width="290" align="center">
                    <hr style="width:500px; color:#69F"/>
  <tr>
    <td><a href="#" style="text-decoration:none">Subscribe &nbsp;|&nbsp;</a></td>
    <td ><a href="#" style="text-decoration:none">About Us &nbsp;|&nbsp;</a></td>
    <td><a href="teacher_info_selection.php" style="text-decoration:none">Teachers &nbsp;|&nbsp;</a></td>
    <td><a href="#" style="text-decoration:none">FAQ &nbsp;|&nbsp;</a></td>
    <td> <a href="#" style="text-decoration:none">Contact Us</a></td>
  </tr>
</table>

</td></tr>
          </tbody></table>
		  
		  </td></tr>
          </tbody></table>
		  </div>
</div>
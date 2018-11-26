Read the comments in the code.

There must be a uploads folder. Do not change the name of this folder.
    If you change the path of the folder ypu need to change Line 29 in the upload.php file. ->
    
    imageDestionation = 'NEW PATH'.$imageNameNew;
    
Database set up:
   Name: image_DB
	Set up: See image: database_setup_scheme

You must also:
	Make uploads folder permissions Read and write for everyone.

	Right click uploads > Get info > Sharing & Permissions:
	Make everything listed Read & Write.
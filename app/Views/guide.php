<?php include('include/header.php'); ?>
<div class="body flex-grow-1">
        <style>
            .toc-section {
                position: sticky;
                top: 50px ;
                max-height: 100vh;
                overflow-y: auto;
            }
            .toc-section ul {
                list-style: none;
                padding-left: 0;
            }
            .toc-section .has-submenu ul {
                display: none;
                padding-left: 1.25rem;
            }
            .toc-section a {
                text-decoration: none;
                color: #007bff;
            }
            .toc-section a:hover {
                text-decoration: underline;
            }
            @media (max-width: 768px) {
                .toc-section {
                    position: relative;
                    max-height: auto;
                }
            }
        </style>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 p-4 hairline-border">
                    <section  id="dashboard">
                    <h4><b>Dashboard Overview</b></h4>

                        <p>The dashboard provides users with a comprehensive overview of system performance and resource utilization. Key metrics displayed include:</p>

                        <ul>
                            <li><strong>CPU Usage:</strong> Current CPU load percentage and details about the processor model, allowing users to monitor processing capacity.</li>
                            <li><strong>RAM Usage:</strong> Displays the percentage of RAM in use along with the total and available memory, giving insights into memory performance.</li>
                            <li><strong>Storage Usage:</strong> Shows the percentage of storage currently utilized, including the total and available disk space, to help manage storage effectively.</li>
                            <li><strong>Network Performance:</strong> Provides real-time network speed in Mbps and total data usage, enabling users to track bandwidth consumption.</li>
                        </ul>

                        <p>Additional sections include:</p>

                        <ul>
                            <li><strong>System Information:</strong> Highlights system uptime, the number of CPU cores, and traffic statistics.</li>
                            <li><strong>Processes:</strong> Displays the total number of running processes, offering an insight into system activity.</li>
                            <li><strong>Video and Audio Management:</strong> Shows statistics for video files and audio tracks, including total counts, sizes, and lengths.</li>
                            <li><strong>RTMP Links and Playlists:</strong> Lists the total number of RTMP links and playlists, with their respective durations, facilitating content streaming management.</li>
                        </ul>

                        <p>This dashboard serves as a vital tool to monitor and manage your system's resources effectively, ensuring optimal performance and organization of media content.</p>

                    </section>


                    <section  id="Videohelp">
                    <h4><b>Video Management</b></h4>

                        <p>The Video Management allows you to upload and manage your video content seamlessly. This intuitive interface provides the following functionalities:</p>

                        <ul>
                            <li><strong>Upload Videos:</strong> You can easily upload new video files, facilitating quick addition of content to your library.</li>
                            <li><strong>Video Overview:</strong> It displays a comprehensive list of uploaded videos, including essential details such as the video name, length, size, and upload date and time.</li>
                            <li><strong>Manage Content:</strong> You can review your video library, allowing for efficient organization and management of video assets.</li>
                        </ul>

                        <p>This serves as a central hub for video management, enabling you to keep your content organized and accessible while ensuring smooth workflow and effective media handling.</p>

                    </section>

                    <section  id="addvideo">
                        <h4>Add Video</h4>

                        <p>The Add Video section allows you to easily submit your video files for management and organization. Below are the key components:</p>

                        <ul>
                            <li><strong>Video Name:</strong> Specify a name for your video. Enter a descriptive name to help you identify the video later.</li>
                            <li><strong>Select Video File:</strong> Use this option to choose the video file from your device. After selecting a file, its name will be displayed, indicating that the file has been successfully chosen.</li>
                        </ul>

                        <h5>Step-by-Step Process to Upload a Video File</h5>

                        <ol>
                            <li><strong>Access the Upload Section:</strong> Click on the "Upload Video" button to open the upload options here.</li>
                            <li><strong>Enter Video Name:</strong> In the "Video Name" field, provide a suitable name for your video. This name will help you easily locate and identify the video later.</li>
                            <li><strong>Select Your Video File:</strong> Click on the "Select Video File" button. A file dialog will open, allowing you to navigate to the location of your video file on your device.</li>
                            <li><strong>Choose Your Video File:</strong> Locate the desired video file and select it. Once selected, the name of the file will be displayed next to the button, confirming your selection.</li>
                            <li><strong>Upload the Video:</strong> After filling out the video name and selecting the file, click on the "Upload" button to start the upload process. Wait for the upload progress to complete.</li>
                            <li><strong>Confirmation:</strong> Upon successful upload, a confirmation message will be displayed, indicating that your video has been uploaded successfully.</li>
                            <li><strong>View Uploaded Video:</strong> You can now view your uploaded video in the video list here, where you will see its details including the name, length, size, and upload date.</li>
                        </ol>

                        <p>Ensure that you follow these steps to successfully upload your video file and manage your media content effectively.</p>

                    </section>
                    <section  id="renmvideo">
                        <h4>Rename Video</h4>

                        <p>The Rename Video section allows you to change the name of an existing video easily. Follow the steps below to rename your video:</p>

                        <h5>Key Components</h5>
                        <ul>
                            <li><strong>Video Name:</strong> This field allows you to enter a new name for the selected video. Ensure that the name is descriptive and unique to help you identify the video later.</li>
                            <li><strong>Cancel Button:</strong> This button allows you to exit the renaming process without making any changes to the video name.</li>
                            <li><strong>Rename Button:</strong> Click this button to save the new video name after entering it in the text field.</li>
                        </ul>

                        <h5>Step-by-Step Process to Rename a Video</h5>

                        <ol>
                            <li><strong>Open the Rename Section:</strong> Click on the "Rename" option next to the video you wish to rename. This will open the rename dialog here.</li>
                            <li><strong>Enter New Video Name:</strong> In the "Video Name" field, input the new name you wish to assign to the video. This field is required; make sure to provide a valid name.</li>
                            <li><strong>Cancel Changes:</strong> If you decide not to rename the video, click the "Cancel" button to close the dialog without saving any changes.</li>
                            <li><strong>Save the New Name:</strong> Once you’ve entered the new name, click the "Rename" button to apply the changes. The system will process the request and update the video name.</li>
                            <li><strong>Verify the Change:</strong> Check the video list here to ensure that the video name has been updated correctly.</li>
                        </ol>

                        <p>By following these steps, you can easily rename your videos and keep your media library organized.</p>

                    </section>
                    <section  id="deletvid">
                        <h4>Delete Video</h4>

                        <p>The Delete Video feature allows you to permanently remove a video from your library. This action is irreversible, so it’s important to be certain before proceeding. When you choose to delete a video, you will see a confirmation prompt to ensure that you truly want to remove the selected video. This helps prevent accidental deletions and maintains the integrity of your media library.</p>

                        <h5>Step-by-Step Process to Delete a Video</h5>

                        <ol>
                            <li><strong>Select the Video:</strong> Locate the video you wish to delete in your video list here.</li>
                            <li><strong>Initiate Deletion:</strong> Click on the "Delete" option next to the video. This action will trigger a confirmation prompt.</li>
                            <li><strong>Review the Confirmation Message:</strong> The prompt will ask, "Are you sure?" along with a warning that states you won’t be able to revert this action. Ensure that you fully understand the implications of deleting the video.</li>
                            <li><strong>Confirm Deletion:</strong> If you are certain about your decision, click on "Yes, delete it!" to proceed with the deletion of the video.</li>
                            <li><strong>Cancel if Necessary:</strong> If you change your mind about deleting the video, click "Cancel" to exit the confirmation prompt without making any changes.</li>
                        </ol>

                        <p>By following these steps, you can manage your video library effectively and ensure that deletions are intentional and confirmed.</p>

                    </section>

                    <section  id="plhelp">
                        <h4><b>Playlist</b></h5>

                        <p>Here, you can create and manage your RTMP streams efficiently. This section is designed for users to easily set up streaming sessions, allowing you to broadcast your content seamlessly. Whether you're streaming live events, music, or other media, this feature provides you with the tools to organize and control your streaming experience.</p>

                        <h5>Key Features</h5>
                        <ul>
                            <li><strong>Create Stream:</strong> Initiate a new stream by defining its name and settings. You can also choose options such as loop playback to enhance your streaming experience.</li>
                            <li><strong>Edit Stream:</strong> Modify existing streams to update their details or configurations, ensuring your streams are always up to date.</li>
                            <li><strong>Add RTMP Links:</strong> Incorporate RTMP links directly into your streams, enabling you to connect and broadcast your content effortlessly.</li>
                            <li><strong>Manage Videos:</strong> Organize and rearrange videos within your streams. You can add or remove videos as needed, making your streaming sessions more dynamic and engaging.</li>
                        </ul>

                        <p>By leveraging these features, you can create a versatile streaming environment that meets your needs and enhances viewer engagement. Whether you're a content creator, musician, or live broadcaster, managing your streams here ensures a smooth and professional streaming experience.</p>

                    </section>
                    <section  id="crplay">
                        <h4>Create Playlist</h4>

                        <p>Follow these steps to create a new playlist in your RTMP streaming application:</p>

                        <ol>
                            <li>
                                <strong>Access the Create Playlist Option:</strong> 
                                Click on the "Create Playlist" button available in the playlist section of your application to open the creation modal.
                            </li>
                            <li>
                                <strong>Enter Playlist Name:</strong> 
                                In the provided input field, type a unique name for your playlist. This name will help you identify the playlist later.
                                <div class="invalid-feedback">Please enter a playlist name.</div>
                            </li>
                            <li>
                                <strong>Enable Loop Playback (Optional):</strong> 
                                If you want the playlist to repeat continuously after it finishes, check the "Loop Playback" option.
                            </li>
                            <li>
                                <strong>Create the Playlist:</strong> 
                                After entering the name and selecting any desired options, click the "Create Playlist" button to finalize the creation process.
                            </li>
                            <li>
                                <strong>Confirmation:</strong> 
                                Once the playlist is created successfully, you will see it listed in the playlist section, ready for you to manage and use.
                            </li>
                        </ol>

                        <p>With these simple steps, you can efficiently create a playlist that organizes your streaming content, making it easier for you and your viewers to access and enjoy.</p>

                    </section>
                    <section  id="edtplay">
                        <h4>Edit Playlist</h4>

                        <p>Follow these steps to edit an existing playlist in your RTMP streaming application:</p>

                        <ol>
                            <li>
                                <strong>Select the Playlist to Edit:</strong> 
                                Navigate to the playlist section and find the playlist you want to edit. Click on the edit button associated with that playlist to open the edit modal.
                            </li>
                            <li>
                                <strong>Update Playlist Name:</strong> 
                                In the input field provided, change the name of the playlist to your desired title. Ensure it is unique to avoid confusion.
                                <div class="invalid-feedback">Please enter a playlist name.</div>
                            </li>
                            <li>
                                <strong>Adjust Loop Playback Setting (Optional):</strong> 
                                If you wish to enable or disable loop playback, check or uncheck the "Loop Playback" option as per your requirements.
                            </li>
                            <li>
                                <strong>Save Changes:</strong> 
                                Once you have made the necessary updates, click the "Edit Playlist" button to save your changes.
                            </li>
                            <li>
                                <strong>Confirmation:</strong> 
                                After successfully saving, your playlist will reflect the new changes, and you can view it in the playlist section.
                            </li>
                        </ol>

                        <p>By following these steps, you can easily edit your playlists to keep them relevant and engaging for your audience.</p>

                    </section>
                    <section  id="deltplay">
                        <h4>Delete Playlist</h4>

                        <p>Follow these steps to delete an existing playlist in your RTMP streaming application:</p>

                        <ol>
                            <li>
                                <strong>Locate the Playlist to Delete:</strong> 
                                Go to the playlist section and identify the playlist you wish to delete. Click on the delete button associated with that playlist.
                            </li>
                            <li>
                                <strong>Confirm Deletion:</strong> 
                                A confirmation prompt will appear, asking if you are sure you want to delete the playlist. Review the message to understand that this action is irreversible.
                            </li>
                            <li>
                                <strong>Proceed with Deletion:</strong> 
                                If you are certain about deleting the playlist, click the "Yes, delete it!" button to finalize the deletion process. If you change your mind, click "Cancel" to abort the operation.
                            </li>
                            <li>
                                <strong>Check for Confirmation:</strong> 
                                After deletion, you should receive a confirmation message indicating that the playlist has been successfully removed. The playlist will no longer appear in the playlist section.
                            </li>
                        </ol>

                        <p>By following these steps, you can manage your playlists effectively by removing those that are no longer needed, ensuring your content remains organized and up to date.</p>

                    </section>
                    <section  id="mngrtmp">
                        <h4>Manage Links</h4>

                        <p>The <strong>RTMP link</strong> (Real-Time Messaging Protocol link) is essential for streaming video and audio content over the internet. It allows for low-latency transmission, making it suitable for live broadcasts and interactive streaming. An RTMP link consists of a server address and a stream key, which together direct the streaming software to the appropriate destination.</p>

                        <p>To obtain an RTMP link, you typically need to sign up with a streaming service that provides RTMP support, such as YouTube Live, Twitch, or Facebook Live. Once registered, navigate to the streaming settings or dashboard of the platform to find your unique RTMP URL and stream key. For instance, on YouTube, you can find your RTMP link under the "Live Streaming" section, where it is usually presented as:</p>

<pre class="docs-code-snippet">rtmp://a.rtmp.youtube.com/live2</pre>

                        <p>Followed by your specific stream key:</p>

<pre class="docs-code-snippet">abcd-efgh-ijkl-mnop</pre>

                        <p>Your complete RTMP link for streaming would then look like:</p>

<pre class="docs-code-snippet">rtmp://a.rtmp.youtube.com/live2/abcd-efgh-ijkl-mnop</pre>

                        <p>In this application, managing your RTMP links allows you to ensure that your playlists are correctly configured for streaming, enabling seamless live broadcasts.</p>

                    </section>
                    <section  id="addrtmp">
                        <h5><b>Add Links</b></h5>

                        <p>Follow these steps to add RTMP links to your playlists:</p>

                        <ol>
                            <li>
                                <strong>Open the Add Link Section:</strong> 
                                Click on the "Add Link" button to access the area for entering your RTMP link and key.
                            </li>
                            <li>
                                <strong>Enter the RTMP Link:</strong> 
                                In the designated input field, type your RTMP link. Ensure that the link is correct and follows the RTMP format. 
                            </li>
                            <li>
                                <strong>Input the RTMP Key:</strong> 
                                In the adjacent input field, enter the corresponding RTMP key. This key is crucial as it identifies your specific stream.
                            </li>
                            <li>
                                <strong>Add the Link:</strong> 
                                Once both fields are filled out, click the "Add" button to save the RTMP link and key. The new link will then be added to your playlist.
                            </li>
                            <li>
                                <strong>Review the Added Links:</strong> 
                                Check the list of links displayed in the table below the input fields to confirm that your new RTMP link and key have been successfully added.
                            </li>
                        </ol>

                        <p>By following these steps, you can efficiently manage the RTMP links associated with your playlists, ensuring your streaming setup is correctly configured.</p>
                    </section>
                    <section  id="rmvrtmp">
                        <h5><b>Remove Links</b></h5>

                        <p>Follow these steps to remove RTMP links from your playlists:</p>

                        <ol>
                            <li>
                                <strong>Locate the Link:</strong> 
                                In the list of RTMP links displayed, find the link you wish to remove.
                            </li>
                            <li>
                                <strong>Select the Remove Option:</strong> 
                                Next to the link, click the "Remove" button. This action will prompt a confirmation to ensure that you intend to delete the link.
                            </li>
                            <li>
                                <strong>Confirm Removal:</strong> 
                                In the confirmation prompt, verify that you want to remove the link. This step ensures that no accidental deletions occur.
                            </li>
                            <li>
                                <strong>Link Removal:</strong> 
                                Once confirmed, the RTMP link will be permanently removed from your playlist. 
                            </li>
                            <li>
                                <strong>Verify Changes:</strong> 
                                Check the list of links again to ensure that the link has been successfully removed and that your playlist is up to date.
                            </li>
                        </ol>

                        <p>By following these steps, you can effectively manage and maintain the RTMP links associated with your playlists, ensuring they align with your streaming needs.</p>

                    </section>
                    <section  id="mngvideo">
                        <h4>Manage Video</h4>

                        <p>In this section, you can efficiently manage your video content within the application. Here are the key features available:</p>

                        <ul>
                            <li><strong>View Videos:</strong> Access a list of all uploaded videos along with essential details such as name, duration, and size.</li>
                            <li><strong>Reorder Videos:</strong> Adjust the order of videos in your playlists by dragging and dropping them as needed, allowing for customizable viewing sequences.</li>
                            <li><strong>Add Videos to Playlists:</strong> Select videos from your library to include in specific playlists, enhancing organization and accessibility.</li>
                            <li><strong>Remove Videos:</strong> Easily remove any video from the playlist or library, keeping your content organized and relevant.</li>
                        </ul>

                        <p>This functionality ensures that you have complete control over your video content, allowing for efficient management and a tailored viewing experience for your audience.</p>

                    </section>
                    <section id="addvdo">
                        <h6><b>Add Video to Playlist</b></h6>

                        <p>To add a video to an existing playlist, follow these steps:</p>

                        <ol>
                            <li>
                                <strong>Open the Manage Video Section:</strong> 
                                Navigate to the area where you can manage your playlists. This is typically accessible through the main dashboard or playlist management interface.
                            </li>
                            <li>
                                <strong>Select a Video:</strong> 
                                In the dropdown menu labeled <strong>Select Video</strong>, click to expand the list of available videos. This list will include all videos you have previously uploaded.
                            </li>
                            <li>
                                <strong>Pick a Video:</strong> 
                                Scroll through the dropdown and click on the video you wish to add to the playlist. Ensure that it is the correct video you intend to include.
                            </li>
                            <li>
                                <strong>Add the Video:</strong> 
                                After selecting the video, click on the <strong>Add</strong> button next to the dropdown. This action will add the selected video to your playlist.
                            </li>
                            <li>
                                <strong>Confirmation:</strong> 
                                Once the video is added, you should see it listed in the playlist management section, confirming that the addition was successful.
                            </li>
                        </ol>

                        <p>Following these steps will enable you to efficiently add videos to your playlists, enhancing your streaming experience.</p>

                    </section>
                    <section id="rmvvdo">
                        <h6><b>Remove Video from Playlist</b></h6>

                        <p>To remove a video from an existing playlist, follow these steps:</p>

                        <ol>
                            <li>
                                <strong>Access the Playlist Management Section:</strong> 
                                Navigate to the area where you can manage your playlists. This can usually be found on your main dashboard or within the playlist management interface.
                            </li>
                            <li>
                                <strong>Select the Playlist:</strong> 
                                Identify the specific playlist from which you want to remove a video. Click on the option to manage that playlist.
                            </li>
                            <li>
                                <strong>Locate the Video:</strong> 
                                In the list of videos associated with the playlist, find the video you wish to remove. Review the list carefully to ensure you select the correct video.
                            </li>
                            <li>
                                <strong>Click Remove:</strong> 
                                Next to the video you want to remove, click the <strong>Remove</strong> button. This action will initiate the removal process.
                            </li>
                            <li>
                                <strong>Confirm Removal:</strong> 
                                A confirmation prompt may appear, asking if you are sure you want to remove the video. Confirm your choice to finalize the removal.
                            </li>
                            <li>
                                <strong>Check for Confirmation:</strong> 
                                Once the video is removed, verify that it is no longer listed in the playlist. This ensures the removal was successful.
                            </li>
                        </ol>

                        <p>By following these steps, you can effectively manage your playlists by removing unwanted videos.</p>

                    </section>               
                    <section id="plstrmstrt"> 
                        <h4>Start Stream</h4>

                        <p>Once you have successfully added videos and links to your playlist, you can start your stream. Here’s what to expect:</p>

                        <ul>
                            <li>
                                <strong>Check Your Playlist:</strong> Ensure that your playlist contains the desired videos and RTMP links. If everything is set up correctly, you will see the option to start the stream in the dropdown menu.
                            </li>
                            <li>
                                <strong>Select to Start Streaming:</strong> Click on the dropdown menu and select the option to start your stream. This action will initiate the streaming process using the selected playlist.
                            </li>
                            <li>
                                <strong>Preview the Stream:</strong> After starting the stream, you can view the live preview by clicking on the status of your playlist. This allows you to monitor your stream in real-time.
                            </li>
                        </ul>

                        <p>By following these steps, you can easily start your stream and ensure everything is functioning as intended!</p>

                    </section>
                    <section id="plstrmstop">
                        <h4>Stop Stream</h4>

                        <p>When you need to end your streaming session, you can stop the stream with ease. Here’s how it works:</p>

                        <ul>
                            <li>
                                <strong>Locate the Stop Option:</strong> In the dropdown menu, you will find the option to stop the stream. This option will be available only when a stream is currently active.
                            </li>
                            <li>
                                <strong>Confirm Stopping the Stream:</strong> Click on the stop option to end your streaming session. This action will terminate the current stream and free up resources for future use.
                            </li>
                            <li>
                                <strong>Check Stream Status:</strong> After stopping the stream, you can verify that it has successfully ended by checking the status of your playlist. The status will update accordingly to indicate that the stream is no longer active.
                            </li>
                        </ul>

                        <p>By following these steps, you can quickly and efficiently stop your stream whenever necessary!</p>

                    </section>
                    <section  id="mvhelp">
                        <h4><b>Music Video</b></h4>
                        <p>
                            This section allows you to create, manage, and control your live music video streams with ease. 
                            You can start by creating a new video, where you will provide a name and upload a video or image file. 
                            Once your video is ready, you can manage your playlists, add or remove links, and control audio settings.
                        </p>
                        <p>
                            To create a live music video stream, simply click on the <strong>Create Video</strong> button, fill in the necessary details, 
                            and upload your content. You can then start the stream, preview it, and monitor its status.
                            The intuitive interface ensures you have full control over your streaming experience, allowing for smooth and engaging live broadcasts.
                        </p>
                    </section>
                    <section id="cretmv">
                        <h4>Create Music Video</h4>
                        <p>
                            Follow these steps to create your music video for live streaming. Ensure you have all the necessary information and files ready before you start.
                        </p>
                        <ol>
                            <li>
                                <strong>Open the Create Video Interface:</strong>
                                <br>Click on the <strong>Create Video</strong> button located at the top of the Music Video Streams section to open the create video interface.
                            </li>
                            <li>
                                <strong>Enter Video Name:</strong>
                                <br>In the <strong>Video Name</strong> input field, type a descriptive name for your video. This name will help you identify the video later.
                            </li>
                            <li>
                                <strong>Select Video or Image:</strong>
                                <br>Click on the <strong>Select Video or Image</strong> button to browse your files. Choose the video or image you wish to upload. Ensure the file format is either video or image.
                            </li>
                            <li>
                                <strong>Set Loop Playback (Optional):</strong>
                                <br>If you want your video to loop continuously during playback, check the <strong>Loop Playback</strong> checkbox.
                            </li>
                            <li>
                                <strong>Upload Progress:</strong>
                                <br>Once you click the <strong>Create Video</strong> button, a progress bar will appear, indicating the upload progress. Wait until the upload is complete.
                            </li>
                            <li>
                                <strong>Completion:</strong>
                                <br>After the upload is complete, you will receive a confirmation message. Your video is now ready for streaming.
                            </li>
                        </ol>
                    </section>
                    <section id="edtmv">
                        <h4>Edit Music Video</h4>
                        <p>
                            Use the Edit Music Video feature to update or modify an existing video in your stream library. Follow these steps to edit the video details or replace the file.
                        </p>
                        <ol>
                            <li>
                                <strong>Open the Edit Video Interface:</strong>
                                <br>Locate the music video you wish to edit in the Music Video Streams list. Click the <strong>Edit</strong> option next to the video name to open the edit interface.
                            </li>
                            <li>
                                <strong>Update Video Name:</strong>
                                <br>If you need to change the name, type the new name in the <strong>Video Name</strong> input field. Ensure the new name is descriptive for easy identification.
                            </li>
                            <li>
                                <strong>Replace Video or Image (Optional):</strong>
                                <br>If you want to replace the existing file, click <strong>Select Video or Image</strong> to upload a new video or image. Ensure the format is either video or image. This step is optional if you only need to update the video details.
                            </li>
                            <li>
                                <strong>Set Loop Playback (Optional):</strong>
                                <br>To enable continuous looping for the video, check the <strong>Loop Playback</strong> box. Leave it unchecked if looping is not needed.
                            </li>
                            <li>
                                <strong>Upload Progress:</strong>
                                <br>After making all necessary changes, click the <strong>Update Video</strong> button. If a new file is being uploaded, a progress bar will show the upload status. Wait for the upload to complete.
                            </li>
                            <li>
                                <strong>Confirmation:</strong>
                                <br>Upon successful update, you will see a confirmation message, and your changes will be saved.
                            </li>
                        </ol>
                    </section>
                    <section id="deltmv">
                        <h4>Delete Music Video</h4>
                        <p>
                            Use the Delete Music Video option to permanently remove an unwanted video from your stream library. Follow these steps to delete a video securely.
                        </p>
                        <ol>
                            <li>
                                <strong>Locate the Video:</strong>
                                <br>In the <strong>Music Video Streams</strong> list, find the music video you want to delete.
                            </li>
                            <li>
                                <strong>Select Delete:</strong>
                                <br>Click the <strong>Delete</strong> option next to the video name. A confirmation prompt will appear to ensure you intend to delete this video.
                            </li>
                            <li>
                                <strong>Confirm Deletion:</strong>
                                <br>Review the prompt carefully, as deleting the video will permanently remove it from the library. Click <strong>Confirm</strong> to proceed, or <strong>Cancel</strong> if you change your mind.
                            </li>
                            <li>
                                <strong>Deletion Confirmation:</strong>
                                <br>Once deleted, the video will no longer be visible in the Music Video Streams list, and a confirmation message will indicate successful removal.
                            </li>
                        </ol>
                        <p>
                            <strong>Note:</strong> Ensure that the music video is no longer needed before confirming deletion, as this action is irreversible.
                        </p>
                    </section>
                    <section id="mngmvaud">
                        <h4>Add Audio</h4>
                        <p>
                            The <strong>Add Audio</strong> feature allows you to enhance your music video by adding custom audio tracks. You can select an audio or video file from your device to serve as the background sound for your stream. Once added, the audio can be managed within your video stream, enabling you to create a dynamic and engaging audio-visual experience for your audience.
                        </p>
                        <p>
                            Adding audio is a quick way to personalize your stream, offering flexibility with options for looping, volume control, and adjustments to match the mood of your video content.
                        </p>
                    </section>
                    <section id="addmvaud">
                        <h5><b>Add Audio</b></h5>
                        <ol>
                            <li>
                                Open the <strong>Music Video Streams</strong> page and locate the music video you wish to add audio to.
                            </li>
                            <li>
                                In the <strong>Activity</strong> column, click the options icon to reveal available actions, then select <strong>Manage Audio</strong>.
                            </li>
                            <li>
                                In the <strong>Manage Audio</strong> interface, locate the <strong>Add Audio</strong> form at the bottom of the table.
                            </li>
                            <li>
                                Enter a descriptive <strong>Audio Name</strong> for easy identification.
                            </li>
                            <li>
                                Select an audio or video file by clicking the <strong>Choose File</strong> button. The system supports both audio files (e.g., MP3) and video files for flexible integration.
                            </li>
                            <li>
                                Click <strong>Add</strong> to upload your selected audio file to the music video. A progress bar will display the upload status.
                            </li>
                            <li>
                                Once complete, the audio file will appear in the list, ready to be played, managed, or removed as needed.
                            </li>
                        </ol>
                        <p>
                            You can now preview and adjust the audio settings within the video stream, ensuring optimal playback for your live music video.
                        </p>
                    </section>
                    <section id="rmvmvaud">
                        <h5><b>Remove Audio</b></h5>
                        <ol>
                            <li>
                                Open the <strong>Music Video Streams</strong> page and locate the music video from which you wish to remove audio.
                            </li>
                            <li>
                                In the <strong>Activity</strong> column, click the options icon to reveal available actions, then select <strong>Manage Audio</strong>.
                            </li>
                            <li>
                                In the <strong>Manage Audio</strong> interface, locate the audio file you want to remove in the list.
                            </li>
                            <li>
                                Next to the audio entry, click the <strong>Remove</strong> or <strong>Delete</strong> button to initiate the removal process.
                            </li>
                            <li>
                                Confirm the deletion when prompted to permanently remove the audio file from the music video. The audio entry will disappear from the list, indicating it has been successfully removed.
                            </li>
                        </ol>
                        <p>
                            Removing audio files allows you to customize and update your music video’s sound content, ensuring the best experience for your live stream audience.
                        </p>
                    </section>
                    <section id="mngmvlink">
                        <h4>Stream Link</h4>
                        <p>
                            An <strong>RTMP Link</strong> (Real-Time Messaging Protocol) is a URL used to connect to a live streaming server, allowing your music video to be broadcast in real-time. The RTMP link, combined with a unique <strong>RTMP Key</strong>, forms the necessary credentials for streaming your video content to a specified destination.
                        </p>
                        <p>
                            Typically, streaming platforms such as YouTube, Facebook, and custom servers provide an RTMP link and key. For example, on YouTube:
                        </p>
                        <ul>
                            <li>Navigate to YouTube Studio, select <strong>Go Live</strong>, and locate the <strong>Stream Settings</strong> section.</li>
                            <li>Here, you'll find the <strong>Stream URL</strong> (the RTMP link) and a <strong>Stream Key</strong>.</li>
                        </ul>
                        <p>
                            Copy the RTMP link and key into your streaming application to establish the connection and start broadcasting your live music video.
                        </p>
                    </section>
                    <section id="addmvlnk">
                        <h5><b>Add Link</b></h5>
                        <p>Follow these steps to add a streaming link to your music video stream.</p>

                        <ol>
                            <li><strong>Open the Link Manager:</strong> In the Music Video Streams section, select the video to which you'd like to add a link.</li>
                            
                            <li><strong>Enter the RTMP Link:</strong> In the provided input field, enter the RTMP Link obtained from your streaming platform (e.g., YouTube or Facebook).</li>
                            
                            <li><strong>Enter the RTMP Key:</strong> In the RTMP Key field, enter the unique key provided by your streaming platform. This key ensures the stream connects securely to your channel.</li>

                            <li><strong>Save the Link:</strong> Click the <em>Add</em> button to save the link. The link will now appear in your link list, ready for use in live streaming.</li>
                        </ol>
                    </section>
                    <section id="rmvmvlink">
                        <h5><b>Remove Link</b></h5>
                        <p>Follow these steps to successfully remove an RTMP link associated with a music video in your streaming application:</p>

                        <ol>
                        <li><strong>Navigate to Manage Links:</strong> In the <em>Music Video Streams</em> section, locate the playlist or video associated with the link you wish to remove.</li>
                        <li><strong>Open Link Management:</strong> Click on the <em>Link</em> field for the selected video. This will display all added RTMP links.</li>
                        <li><strong>Identify the Link:</strong> From the list, identify the specific RTMP link you wish to remove.</li>
                        <li><strong>Delete the Link:</strong> Beside the link, click the <em>Remove</em> or <em>Delete</em> button to remove it from the list.</li>
                        <li><strong>Confirm the Deletion:</strong> Verify that the link has been successfully removed from the list.</li>
                        </ol>

                        <p>After completing these steps, the RTMP link will no longer be associated with the video or playlist. If additional links need to be removed, repeat the above steps as necessary.</p>

                    </section>
                    <section id="mngmvstrt"> 
                        <h4>Start Stream</h4>

                        <p>Once you have successfully added videos and links to your video, you can start your stream. Here’s what to expect:</p>

                        <ul>
                            <li>
                                <strong>Check Your video:</strong> Ensure that your video contains the desired audio and RTMP links. If everything is set up correctly, you will see the option to start the stream in the dropdown menu.
                            </li>
                            <li>
                                <strong>Select to Start Streaming:</strong> Click on the dropdown menu and select the option to start your stream. This action will initiate the streaming process using the selected video.
                            </li>
                            <li>
                                <strong>Preview the Stream:</strong> After starting the stream, you can view the live preview by clicking on the status of your video. This allows you to monitor your stream in real-time.
                            </li>
                        </ul>

                        <p>By following these steps, you can easily start your stream and ensure everything is functioning as intended!</p>
                    </section>
                    <section id="mngmvstop">
                        <h4>Stop Stream</h4>

                        <p>When you need to end your streaming session, you can stop the stream with ease. Here’s how it works:</p>

                        <ul>
                            <li>
                                <strong>Locate the Stop Option:</strong> In the dropdown menu, you will find the option to stop the stream. This option will be available only when a stream is currently active.
                            </li>
                            <li>
                                <strong>Confirm Stopping the Stream:</strong> Click on the stop option to end your streaming session. This action will terminate the current stream and free up resources for future use.
                            </li>
                            <li>
                                <strong>Check Stream Status:</strong> After stopping the stream, you can verify that it has successfully ended by checking the status of your playlist. The status will update accordingly to indicate that the stream is no longer active.
                            </li>
                        </ul>

                        <p>By following these steps, you can quickly and efficiently stop your stream whenever necessary!</p>
                    </section>
                    <section id="strmover">
                        <h4>Overview</h4>
                        <p>The <?= esc(aboutdetails()['sitedetails']['Name']) ?> offers a comprehensive platform for creating, managing, and broadcasting music video streams with ease and flexibility. With features such as playlist management, customizable video and audio content, and RTMP link integration, this application provides a robust and user-friendly solution for live streaming. From the initial setup to going live, each feature is designed to give you complete control over the streaming experience.</p>
                        <h5><b>Key Features</b></h5>
                        <ul>
                        <li><strong>Create and Manage Playlists:</strong> Users can organize music videos into playlists, facilitating seamless content management for live streaming.</li>
                        <li><strong>Customizable Video Content:</strong> Upload and edit video content to be used in live streams, with options to loop playback for continuous streaming.</li>
                        <li><strong>Audio Integration:</strong> Add or remove audio tracks to enhance the streaming experience, providing greater control over the audio elements in the stream.</li>
                        <li><strong>RTMP Link Management:</strong> Integrate RTMP links for connecting the stream to various broadcast servers or third-party streaming platforms.</li>
                        <li><strong>Live Streaming Control:</strong> Start or stop streams directly from <?= esc(aboutdetails()['sitedetails']['Name']) ?>, and monitor live stream status with real-time updates.</li>
                        </ul>

                        <h5><b><?= esc(aboutdetails()['sitedetails']['Name']) ?> Workflow</b></h5>
                        <p>The following workflow provides a comprehensive overview of the typical process for setting up and managing streams:</p>

                        <ol>
                        <li><strong>Create Music Video:</strong> Begin by uploading video content and configuring playback settings. Each video can be tailored to specific requirements, including looping options for uninterrupted playback.</li>
                        <li><strong>Add Audio Tracks:</strong> Enhance the video content by attaching audio tracks. Users can add multiple audio files to customize the background sound for the stream.</li>
                        <li><strong>Set Up RTMP Links:</strong> Once the video and audio are configured, add RTMP links to establish a connection to a broadcast server. This enables the video content to be streamed across various platforms.</li>
                        <li><strong>Create and Organize Playlists:</strong> Organize videos into playlists, making it easy to group content for specific events or themes. Playlists streamline content management and allow for quick updates to the streaming lineup.</li>
                        <li><strong>Control Live Stream:</strong> When all content is prepared, use the streaming control options to initiate or terminate streams, ensuring you have complete control over the broadcast timing and visibility.</li>
                        </ol>


                        <p><?= esc(aboutdetails()['sitedetails']['Name']) ?> is designed for ease of use and optimal performance in streaming content. The streamlined interface, integrated RTMP link management, and comprehensive playlist features provide a powerful solution for music streaming applications. Each component—whether creating a video, managing links, or adding audio—contributes to an efficient, user-friendly experience for live broadcasting.</p>

                        <p>We hope <?= esc(aboutdetails()['sitedetails']['Name']) ?> empowers you to deliver seamless, engaging, and dynamic music video streams. For any additional support, refer to the documentation, which provides in-depth guides on each feature to assist you in achieving the best streaming results.</p>


                    </section>

                </div>

                <div class="col-lg-3 toc-section">
                    <h5 class="pt-4">Index</h5>
                    <ul>
                        <li><a href="#dashboard">Dashboard</a></li>
                        <li class="has-submenu"><a href="#Videohelp">Video</a>
                            <ul>
                                <li><a href="#addvideo">Add Video</a></li>
                                <li><a href="#renmvideo">Rename Video</a></li>
                                <li><a href="#deletvid">Delete Video</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#plhelp">Playlist</a>
                            <ul>
                                <li><a href="#crplay">Create Playlist</a></li>
                                <li><a href="#edtplay">Edit Playlist</a></li>
                                <li><a href="#deltplay">Delete Playlist</a></li>
                                <li class="has-submenu"><a href="#mngrtmp">Manage Links</a>
                                    <ul>
                                        <li><a href="#addrtmp">Add Links</a></li>
                                        <li><a href="#rmvrtmp">Remove Links</a></li>
                                    </ul>
                                </li>
                                <li class="has-submenu"><a href="#mngvideo">Manage Video</a>
                                    <ul>
                                        <li><a href="#addvdo">Add Video</a></li>
                                        <li><a href="#rmvvdo">Remove Video</a></li>
                                    </ul>
                                </li>
                                <li><a href="#plstrmstrt">Start Stream</a></li>
                                <li><a href="#plstrmstop">Stop Stream</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#mvhelp">Music Video</a>
                            <ul>
                                <li><a href="#cretmv">Create Music</a></li>
                                <li><a href="#edtmv">Edit Music</a></li>
                                <li><a href="#deltmv">Delete Music</a></li>
                                <li class="has-submenu"><a href="#mngmvaud">Add Audio</a>
                                    <ul>
                                        <li><a href="#addmvaud">Add Audio</a></li>
                                        <li><a href="#rmvmvaud">Remove Audio</a></li>
                                    </ul>
                                </li>
                                <li class="has-submenu"><a href="#mngmvlink">Stream Link</a>
                                    <ul>
                                        <li><a href="#addmvlnk">Add Link</a></li>
                                        <li><a href="#rmvmvlink">Remove Link</a></li>
                                    </ul>
                                </li>
                                <li><a href="#mngmvstrt">Start Stream</a></li>
                                <li><a href="#mngmvstop">Stop Stream</a></li>
                            </ul>
                        </li>
                        <li><a href="#strmover">Overview</a></li>
                    </ul>
                </div>
            </div>
        </div>

<script>

    document.querySelectorAll('.has-submenu > a').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const submenu = this.nextElementSibling;
            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        });
    });


    document.querySelectorAll('.toc-section a').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            const offset = document.querySelector('.header').offsetHeight;

            if (targetElement) {
            const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - offset;
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
        });
    });


</script>

</div>
<?php include('include/footer.php'); ?>

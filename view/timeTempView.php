    <a href="<?= BASE . "/index.php?action=viewEntry&id=". htmlspecialchars($entry['u_id'])?>">
        <div class="entryContainer">
            <div class="entryTitle" ><?= htmlspecialchars($entry['title']) ?></div>
            <div class="entryContent"><?= htmlspecialchars($entry['text_content']) ?></div>
            <div class="entryInfo">
                <div class="entryTags">
                    tagNames
                    <!-- <?= htmlspecialchars($entry['tagNames']) ?> -->
                </div>
                <div class="entryDate"> <?= htmlspecialchars($entry['month']), " ",htmlspecialchars($entry['day']), ", ", htmlspecialchars($entry['year'])?> </div>
            </div>
        </div>
    </a>



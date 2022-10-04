	<?php

require_once "./model/EntryManager.php";
require_once "./model/UserManager.php";
require_once "./model/TagManager.php";
require_once "./model/FilterManager.php";

//--------------------------------------------------
//----------------PAGE NAVIGATION-------------------
//--------------------------------------------------

function toLanding()
{
	require ROOT . "/view/journeyView.php";
}

function toAboutUs()
{
	require ROOT . "/view/aboutView.php";
}

function toTimeline($u_id, $entry_group)
{
	$entry_manager = new EntryManager();
	$entries = $entry_manager->getEntries($u_id, $entry_group);
	$view = $entry_group;

	require ROOT . "/view/timelineView.php";
}

function toAlbum($u_id)
{
	$entryManager = new EntryManager();
	$res = $entryManager->getAlbum($u_id);
	require ROOT . "/view/albumView.php";
}

function createNewEntry()
{
	require ROOT . "/view/createEntryView.php";
}

function toCalendar()
{
	require ROOT . "/view/calendarView.php";
}

function toMap($u_id, $entry_group)
{
	$entryManager = new EntryManager();
	$entries = $entryManager->getEntries($u_id, $entry_group);
	// echoPre($entries);
	require ROOT . "/view/mapView.php";
}

function toLogout()
{
	session_destroy();
	header("Location: index.php");
}
//--------------------------------------------------
//----------------KAKAO SIGNUP----------------------
//--------------------------------------------------

function kakaoSignUp($data)
{
}

function kakaoValidation($data)
{
}
//--------------------------------------------------
//----------------REGULAR SIGNUP--------------------
//--------------------------------------------------

function regularSignUp($data)
{
	// VALIDATE SIGN-UP FORM
	$validated = regSignUpValidation($data);
	if (count(array_unique($validated)) == 1) {
		$userManager = new UserManager();
		// $check = $userManager->createUser($data, "regular");
		$check = $userManager->createRegUser($data);

		if ($check === false) {
			toTimeline($_SESSION["uid"], "monthly");
		} else {
			// echoPre($check);
			$error_signup = $check;
			require ROOT . "/view/journeyView.php";
		}
	} else {
		$error = array_filter($validated, function ($value) {
			return $value != "1";
		});
		require ROOT . "/view/journeyView.php";
	}
}


function regSignUpValidation($data)
{
	$control = [];
	if (
		isset($data["sign-u"]) and
		isset($data["sign-e"]) and
		isset($data["sign-p"]) and
		isset($data["sign-cp"])
	) {
		$ctrl_u = preg_match("/^[a-zA-Z0-9]{4,}/", $data["sign-u"])
			? true
			: "Your username must include at least 4 characters.";
		$ctrl_e = preg_match(
			"/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",
			$data["sign-e"]
		)
			? true
			: "You must use a proper email address.";
		$ctrl_p = preg_match(
			"/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/",
			$data["sign-p"]
		)
			? true
			: "Your password did not meet the minimum requirements.";
		$ctrl_cp =
			$data["sign-p"] == $data["sign-cp"]
				? true
				: "Your passwords did not match.";

		array_push($control, $ctrl_u, $ctrl_e, $ctrl_p, $ctrl_cp);
		return $control;
	}
}

//--------------------------------------------------
//------------------USER SIGNUP---------------------
//--------------------------------------------------

function signUp($data, $type)
{
	switch ($type) {
		case "regular":
			// TODO: push all values at the end
			$control = [];
			if (
				isset($data["sign-u"]) and
				isset($data["sign-e"]) and
				isset($data["sign-p"]) and
				isset($data["sign-cp"])
			) {
			}
			$ctrl_u = preg_match("/^[a-zA-Z0-9]{4,}/", $data["sign-u"])
				? true
				: "Your username must include at least 4 characters.";
			$ctrl_e = preg_match(
				"/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",
				$data["sign-e"]
			)
				? true
				: "You must use a proper email address.";
			$ctrl_p = preg_match(
				"/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/",
				$data["sign-p"]
			)
				? true
				: "Your password did not meet the minimum requirements.";
			$ctrl_cp =
				$data["sign-p"] == $data["sign-cp"]
					? true
					: "Your passwords did not match.";

			array_push($control, $ctrl_u, $ctrl_e, $ctrl_p, $ctrl_cp);

			if (count(array_unique($control)) == 1) {
				$userManager = new UserManager();
				$check = $userManager->createUser($data, $type);

				if ($check === false) {
					toTimeline($_SESSION["uid"], "monthly");
				} else {
					$error_signup = $check;
					require ROOT . "/view/journeyView.php";
				}
			} else {
				$error = [];
				// TODO: use filter instead
				// array_filter($control, )
				foreach ($control as $value) {
					// if ($value != '1') $error .= $value . '<br>';
					if ($value != "1") {
						array_push($error, $value);
					}
				}
				require ROOT . "/view/journeyView.php";
			}
			break;
		default:
			$userManager = new UserManager();
			$check = $userManager->createUser($data, $type);
			// echoPre($check);
			if ($check === false) {
				toTimeline($_SESSION["uid"], "monthly");
			} else {
				$error_signup = $check;
				require ROOT . "/view/journeyView.php";
			}
			break;
	}
}

//--------------------------------------------------
//----------------USER LOGIN------------------------
//--------------------------------------------------

function login($data, $type)
{
	$userManager = new UserManager();
	$check = $userManager->confirmUser($data, $type);
	if ($check === false) {
		toTimeline($_SESSION["uid"], "monthly");
	} else {
		$error_login = $check;
		require ROOT . "/view/journeyView.php";
	}
}

//--------------------------------------------------
//----------------SOCIAL ACCOUNTS-------------------
//--------------------------------------------------

function googleAccount($data)
{
	$userManager = new UserManager();
	$check = $userManager->confirmUser($data, "google");
	if ($check === false) {
		toTimeline($_SESSION["uid"], "monthly");
	} else {
		$error_login = $check;
		require ROOT . "/view/journeyView.php";
	}
}

function googleValidation()
{
}

//--------------------------------------------------
//----------------ENTRY MANAGEMENT------------------
//--------------------------------------------------

function newEntry($data)
{
	$entryManager = new EntryManager();
	$tagManager = new TagManager();
	if (!empty($data->title) and !empty($data->textContent)) {
		$entry_uid = $entryManager->createEntry($data);
		$tagManager->submitTags($data->tags, $entry_uid);
		if ($_FILES["imgUpload"]["error"] !== 4) {
			$checkImgs = $entryManager->uploadImages($entry_uid);
		} elseif (count($_FILES) > 1 and $_FILES["imgUpload"]["error"] === 4) {
			throw new Exception(
				"Error, image error status 4 - controller.php: newEntry()"
			);
		}
		header("Location: index.php?action=toTimeline");
	} else {
		// throw new Exception('Error, entry ID not returned - controller.php: newEntry()');
		$error = "Not a valid Entry";
		require ROOT . "/view/createEntryView.php";
	}
}

function filterEntries($data)
{
	$entryManager = new EntryManager();
	$filterManager = new FilterManager();
	// $type = "monthly";
	if ($data['filter'] === "") {
		$entries = $entryManager->getEntries($_SESSION["uid"], "monthly");
	} else {
		$entries = $filterManager->filterEntries($_SESSION["uid"], $data['filter'], $data['value']);
		// echoPre($entries);
	}
	require ROOT . "/view/timelineFiltered.php";
}

function toDeleteEntry($data){
    $entryManager = new EntryManager();
    // $entryManager->deleteEntry($data['entryID'], $_SESSION["uid"]);
}

function viewEntry($entryId)
{
	$entryManager = new EntryManager();
	$entryContent = $entryManager->getEntry($entryId, $_SESSION["uid"]);
	require ROOT . "/view/viewEntryView.php";
}

//--------------------------------------------------
//----------------UTILITY FUNCTIONS-----------------
//--------------------------------------------------

function displayMonths($numOfMonths = 5)
{
	$months = [];
	array_push($months, date("F Y"));
	for ($i = 1; $i < $numOfMonths; $i++) {
		array_push($months, Date("F Y", strtotime("-$i month")));
	}
	return $months;
}

function displayDaysInWeek()
{
	$week = [
		"Monday",
		"Tuesday",
		"Wednesday",
		"Thursday",
		"Friday",
		"Saturday",
		"Sunday",
	];
	return $week;
}

function updateLastActive($uid)
{
	$userManager = new UserManager();
	$userManager->updateLastActive($uid);
}

function echoPre($user_fetch)
{
	if (is_array($user_fetch)) {
		echo "<pre>";
		print_r($user_fetch);
		echo "</pre>";
	} else {
		echo "<pre>";
		echo $user_fetch;
		echo "</pre>";
	}
}

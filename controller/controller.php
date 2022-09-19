<?php

require_once('./model/EntryManager.php');
require_once('./model/UserManager.php');

function signUp($data, $type){
  $userManager = new UserManager();
  $check = $userManager->createUser($data, $type);
  switch($check){
    case false:
      require(ROOT . '/view/timelineView.php');
      break;
    case "existingEmail":
      $error = "User with that email already exists. Please try again";
      require(ROOT . '/view/signupView.php');
      break;
  }
}

function login($data, $type){
  $userManager = new UserManager();
  $check = $userManager->confirmUser($data, $type);
  if ($check === false){
    require(ROOT . '/view/timelineView.php');
  } else {
    $error = $check;
    require(ROOT . '/view/loginView.php');
  }
}

function updateLastActive($uid){
  $userManager = new UserManager();
  $userManager->updateLastActive($uid);
}

function newEntry($data){
  $entryManager = new EntryManager();
  if ($entryManager->createEntry($data)){
    require(ROOT . '/view/timelineView.php');
  };
}

function newEntryFailed(){
  $error = "Not a valid entry";
  require(ROOT . '/view/createEntryView.php');
}

function goToLink($page){
  switch ($page){
    case "toLanding":
      require(ROOT . '/view/indexView.php');
      break;
    case "toAbout":
      require(ROOT . '/view/aboutView.php');
      break;
    case "toTimeline":
      require(ROOT . '/view/timelineView.php');
      break;
    case "createEntry":
      require(ROOT . '/view/createEntryView.php');
      break;
    case "toSignUp":
      require(ROOT . '/view/signupView.php');
      break;
    case "toLogin":
      require(ROOT . '/view/loginView.php');
      break;
    case "toTemplate":
      require(ROOT . '/view/TemplateView.php');
      break;
    default:
      break;
  }
}

function viewEntry($entryId){
    $entryManager = new EntryManager();
    $entryContent = $entryManager->getEntry($entryId);
    require(ROOT . '/view/viewEntryView.php');
}

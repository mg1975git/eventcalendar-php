<?php
/* MESSAGGI REGISTRAZIONE LOGIN */
define("LOGIN_REG_CODE_KO",             array("Codice non corretto",					"Incorrect code"));
define("LOGIN_REG_UNAME_ALREADY_EXIST", array("Username già in uso",					"Username already in use"));
define("LOGIN_REG_OK",                  array("Registrazione avvenuta con successo",	"Registration was successful"));
define("LOGIN_REG_ERR",                 array("Errore durante la registrazione",		"Error during registration"));
define("LOGIN_REG_SEND_KO",             array("Errore nell'invio del username.",		"Error sending username."));

/* MESSAGGI LOGIN */
define("LOGIN_UNAME",           array("Il nome utente è richiesto.",							"Username required."));
define("LOGIN_PSW",             array("La password è richiesta.",								"Password required."));
define("LOGIN_UNAME_NO_CHAR",   array("Il nome utente non contiene caratteri a sufficienza.",	"The username does not contain enough characters."));
define("LOGIN_PSW_NO_CHAR",     array("La password non contiene caratteri a sufficienza.",		"The password does not contain enough characters."));
define("LOGIN_UNAME_PSW_KO",    array("Credenziali non valide. Riprova.",						"Invalid credentials. Try again."));
define("LOGIN_UNAME_KO",        array("Username non valido.",									"Invalid username."));
define("LOGIN_CONN_ERR",        array("Connessione fallita.",									"Connection failed."));

/* MESSAGGI EVENTI */
define("EVENT_ALREADY_EXIST",   array("Esiste già un evento compreso nello stesso orario di questo giorno.",	"There is already an event included in the same time on this day"));
define("EVENT_NOT_EXIST",       array("Non esiste questo evento o non è più attivo.",	"This event does not exist or is no longer active."));
define("EVENT_DEL_OK",          array("Evento cancellato correttamente.",			    "Event deleted successfully."));
define("EVENT_DEL_ERR",         array("Errore nella cancellazione dell'evento.",	    "Error in deleting the event."));
define("EVENT_SEND_ERR",        array("Errore nell'invio dei dati.",				    "Error in sending data."));
define("EVENT_NONE",            array("Nessun evento.",								    "No event."));
define("EVENT_DEL_SURE",        array("Sei sicuro di voler cancellare questo evento?",	"Are you sure you want to delete this event?"));
define("EVENT_ID_NOT_SPEC",     array("ID dell'evento non specificato.",				"Event ID not specified."));
define("EVENT_UPD_OK",          array("Evento aggiornato con successo",					"Event updated successfully"));
define("EVENT_UPD_ERR",         array("Errore durante l'aggiornamento.",				"Error during update."));
define("EVENT_INS_OK",          array("Evento inserito con successo",					"Event inserted successfully"));
define("EVENT_INS_ERR",         array("Errore durante l'inserimento.",					"Error during insert."));

/* MESSAGGI SETTINGS */
define("SETTINGS_USER_NO_ACTIVE",       array("L'utente non è più attivo.",	    "The user is no longer active."));
define("SETTINGS_UPD_OK",               array("Dati aggiornati con successo.",	"Data updated successfully."));
define("SETTINGS_INS_ERR",              array("Errore durante l'inserimento",	"Error during insert"));
define("SETTINGS_SEND_ERR",             array("Errore nell'invio dei dati.",	"Error in sending data."));
define("SETTINGS_USER_NOT_FOUND",       array("Utente non trovato",			    "User not found"));

/* MESSAGGI CONTATTI */
define("CONTACT_DEL_OK",    array("Contatto eliminato con successo.",					"Contact successfully deleted."));
define("CONTACT_DEL_ERR",   array("Errore. Contatto non eliminato correttamente.",		"Error. Contact not deleted."));
define("CONTACT_INS_OK",    array("Nuovo contatto inserito correttamente.",			    "New contact entered successfully."));
define("CONTACT_INS_ERR",   array("Errore. Contatto non inserito.",					    "Error. Contact not inserted."));
define("CONTACT_UPD_OK",    array("Contatto aggiornato con successo.",					"Contact updated successfully."));
define("CONTACT_UPD_ERR",   array("Errore. Contatto non aggiornato.",					"Error. Contact not updated."));
define("CONTACT_NONE",      array("Nessun contatto in rubrica.",						"No contacts in the address book."));
define("CONTACT_NOT_EXIST", array("Non esiste questo contatto o non è più attivo.",	    "This contact does not exist or is no longer active."));
?>
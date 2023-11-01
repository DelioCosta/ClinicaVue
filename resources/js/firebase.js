// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getFirestore } from "firebase/firestore";

const firebaseConfig = {
  apiKey: "AIzaSyAUPCLbRV9Off2rVirlTIVWfJ-Vogf5Y7E",
  authDomain: "clinicavue.firebaseapp.com",
  projectId: "clinicavue",
  storageBucket: "clinicavue.appspot.com",
  messagingSenderId: "292326908449",
  appId: "1:292326908449:web:aed58081aa1c73f561f960"
};

// Initialize Firebase
initializeApp(firebaseConfig);
const db = getFirestore();

export default db;

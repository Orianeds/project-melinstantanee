'use client';
import React, { useState } from 'react'

const ContactForm = () =>{
    const [formData, setFormData] = useState({
        name: '',
        firstname: '',
        email: '',
        message: ''
    });

    const [submitting, setSubmitting] = useState(false);

    const handleInputChange = (e) => {
        const {name, value} = e.target;

        setFormData({
            ...formData,
            [name]: value,
            //équivaut à : firstName: 'Oriane'
        });
    }

    const handleSubmit = async (e) => {
        e.preventDefault();
        setSubmitting(true);

        //send email
        const response = await fetch('api/contactez-moi', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(formData),
        });

        const { success, error } = await response.json();

        if (success) {
            alert('Votre message a bien été envoyé');
        } else if (error) {
            console.error(error);
            alert("Oups, un problème est survenu lors de l'envoi")
        }

        setSubmitting(false);
    }



    return(
        <section className="bg-brown/40 textLibre flex flex-col justify-center items-center px-10 pt-36 pb-20">
            <h1>Contactez-Moi</h1>
            <form onSubmit={handleSubmit} className='flex flex-col'>
                <div className='flex justify-between my-4 py-2'>
                    <div className='flex flex-col mr-3'>
                        <label htmlFor="lastName">Nom</label>
                        <input type='text' id='lastName' name='lastName' placeholder='Ecrivez votre nom...' onChange={handleInputChange}/>
                    </div>
                    <div className='flex flex-col ml-3'>
                        <label htmlFor="firstName">Prénom</label>
                        <input type='text' id='firstName' name='firstName' placeholder='Ecrivez votre prénom...' onChange={handleInputChange}/>
                    </div>
                </div>
                <div className='flex flex-col'>
                    <label htmlFor="email">Email</label>
                    <input type='email' id='email' name='email' placeholder='Ecrivez votre email...' onChange={handleInputChange}/>
                </div>
                <div className='flex flex-col'>
                    <label htmlFor="subject">Objet</label>
                    <input type='text' id='subject' name='subject' placeholder='Ecrivez la raison de votre contact...' onChange={handleInputChange}/>
                </div>
                <div className='flex flex-col'>
                    <label htmlFor="message">Message</label>
                    <textarea name="message" id="message" cols='70' rows="5" placeholder='Ecrivez votre message...' className='rounded' onChange={handleInputChange}></textarea>
                </div>
                <button className='bg-brown text-white text-center rounded px-1 my-3 cursor-pointer justify-center' type='submit'>Envoyer le message</button>
            </form>
        </section>
    )
}





// const contact = () => {

//     const send = async() => {
//         "use server"
//         await sendEmail({to:"oriane.dasilva0812@gmail.com", 
//         name:"Da Silva", 
//         firstname:"Oriane", 
//         email:"oriane.dasilva@yahoo.fr", 
//         subject:"test send mail",
//         body:'<h1>Hello World!</h1>'
//         })
//     };
//   return (
//         <main>
//             <form action={send}>
//                 <button>Envoyer</button>
//             </form>
//         </main>
//   )
// }

export default ContactForm
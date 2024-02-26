using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
/*
 * Auteur : Yoann Meier, Alexandre Babich
 * Projet : Administration du jeu web Tu Prefere
 * Description : Page de fonction agissant sur la base de donnée
 */
namespace Backend_TuPreferes.DataBase
{
    public class FunctionDB
    {
        DB db;

        public FunctionDB(DB dB)
        {
            this.db = dB;
        }

        /// <summary>
        /// Retourne tous les dilemmes
        /// </summary>
        public List<string[]> GetAllDilemma()
        {
            List<string[]> results = db.dbRun("SELECT * FROM question");

            if (results != null)
            {
                return results;
            }

            MessageBox.Show("Erreur lors de l'exécution de la requête.");
            return null;
        }

        /// <summary>
        /// Retourne tous les dilemmes d'une catégorie
        /// </summary>
        /// <param name="categorie">nom de la catégorie</param>
        public List<string[]> GetAllDilemmaOfCategory(string categorie)
        {
            MySqlParameter[] parameters = {
                new MySqlParameter("@id", MySqlDbType.Int32) { Value = GetIdCategoryByName(categorie)},
            };
            List<string[]> results = db.dbRun("SELECT * FROM question WHERE idCategorie = @id", parameters);
            if (results != null)
            {
                return results;
            }
            MessageBox.Show("Erreur lors de l'exécution de la requête.");
            return null;
        }

        /// <summary>
        /// Ajoute un dilemme
        /// </summary>
        /// <param name="choix1">choix numéro 1</param>
        /// <param name="choix2">choix numéro 2</param>
        /// <param name="categorie">nom de la catégorie</param>
        public void AddDilemma(string choix1, string choix2, string categorie)
        {
            MySqlParameter[] parameters = {
                new MySqlParameter("@choix1", MySqlDbType.VarChar) { Value = choix1 },
                new MySqlParameter("@choix2", MySqlDbType.VarChar) { Value = choix2 },
                new MySqlParameter("@idCategorie", MySqlDbType.Int32) { Value = GetIdCategoryByName(categorie) }
            };
            db.dbRun("INSERT INTO question (choix1, choix2, idCategorie) VALUES (@choix1, @choix2, @idCategorie)", parameters);
        }

        /// <summary>
        /// Retourne un dilemme avec l'id
        /// </summary>
        /// <param name="id">id du dilemme</param>
        public List<string[]> GetDilemmaOfId(int id)
        {
            MySqlParameter[] parameters = {
                new MySqlParameter("@id", MySqlDbType.Int32) { Value = id},
            };
            List<string[]> results = db.dbRun("SELECT * FROM question WHERE idQuestion = @id", parameters);

            if (results != null)
            {
                return results;
            }

            MessageBox.Show("Erreur lors de l'exécution de la requête.");
            return null;
        }

        /// <summary>
        /// Met à jour le dilemme
        /// </summary>
        public void UpdateDilemme(string choix1, string choix2, int idCategorie, int archiver, int idQuestion)
        {
            MySqlParameter[] parameters = {
                new MySqlParameter("@choix1", MySqlDbType.VarChar) { Value = choix1 },
                new MySqlParameter("@choix2", MySqlDbType.VarChar) { Value = choix2 },
                new MySqlParameter("@archiver", MySqlDbType.Int32) { Value = archiver},
                new MySqlParameter("@idCategorie", MySqlDbType.Int32) { Value = idCategorie},
                new MySqlParameter("@idQuestion", MySqlDbType.Int32) { Value = idQuestion},
            };

            db.dbRun("UPDATE question SET choix1 = @choix1, choix2 = @choix2, archiver = @archiver, idCategorie = @idCategorie WHERE idQuestion = @idQuestion", parameters);
        }

        /// <summary>
        /// Supprime un dilemme avec son id
        /// </summary>
        /// <param name="id">id du dilemme</param>
        public void ArchiveDilemma(int id)
        {
            MySqlParameter[] parameters = {
                new MySqlParameter("@id", MySqlDbType.Int32) { Value = id }
            };
            db.dbRun("UPDATE question SET archiver = 1 WHERE idQuestion = @id", parameters);
        }

        /// <summary>
        /// Retourne l'id de la catégorie avec le nom
        /// </summary>
        /// <param name="nom">nom de la categorie</param>
        public int GetIdCategoryByName(string name)
        {
            MySqlParameter[] parameters ={
                new MySqlParameter("@nom", MySqlDbType.VarChar) { Value = name },
            };

            List<string[]> results = db.dbRun("SELECT idCategorie FROM categorie WHERE nom = @nom", parameters);

            if (results.Count == 0)
            {
                return -1;
            }
            return Convert.ToInt32(results[0][0]);
        }

        /// <summary>
        /// Retourne le nom de la categorie avec l'id
        /// </summary>
        /// <param name="id">id de la categorie</param>
        public string GetNomCategoryById(int id)
        {
            MySqlParameter[] parameters ={
                new MySqlParameter("@id", MySqlDbType.Int32) { Value = id },
            };

            List<string[]> results = db.dbRun("SELECT nom FROM categorie WHERE idCategorie = @id", parameters);

            return results[0][0];
        }

        /// <summary>
        /// Retourne toutes les catégories
        /// </summary>
        public List<string[]> GetAllCategory()
        {
            List<string[]> results = db.dbRun("SELECT * FROM categorie");

            if (results != null)
            {
                return results;
            }

            MessageBox.Show("Erreur lors de l'exécution de la requête.");
            return null;
        }

        /// <summary>
        /// Ajoute une catégorie
        /// </summary>
        /// <param name="category">nom de la categorie</param>
        /// <returns>Message d'erreur ou de succès</returns>
        public string AddCategory(string category)
        {
            MySqlParameter[] parameters ={
            new MySqlParameter("@category", MySqlDbType.String) { Value = category },
         };

            try
            {
                List<string[]> existingCategories = db.dbRun("SELECT nom FROM categorie WHERE nom = @category", parameters);
                if (existingCategories.Count > 0)
                {
                    return "La catégorie existe déjà.";
                }
                db.dbRun("INSERT INTO categorie (nom) VALUES (@category)", parameters);
                return "Catégorie ajoutée avec succès.";
            }
            catch (MySqlException e)
            {
                MessageBox.Show(e.ToString());
                return "Une erreur s'est produite lors de l'ajout de la catégorie.";
            }
        }


        /// <summary>
        /// Change l'état de l'archivage d'une catégorie
        /// </summary>
        /// <param name="id">id de la catégorie</param>
        public void ToggleArchive(int id)
        {
            try
            {
                List<string[]> currentStatus = db.dbRun("SELECT archiver FROM categorie WHERE idCategorie = @id", new MySqlParameter[] { new MySqlParameter("@id", id) });
                if (currentStatus.Count > 0)
                {
                    int currentState = Convert.ToBoolean(currentStatus[0][0]) ? 1 : 0;

                    int newState = (currentState == 0) ? 1 : 0;

                    db.dbRun("UPDATE categorie SET archiver = @newState WHERE idCategorie = @id",
                             new MySqlParameter[] { new MySqlParameter("@newState", newState), new MySqlParameter("@id", id) });

                }
            }
            catch (MySqlException e)
            {
                MessageBox.Show(e.ToString());
            }
        }

        /// <summary>
        /// Modifie le nom d'une categorie avec son nom actuel
        /// </summary>
        /// <param name="oldName">ancien nom</param>
        /// <param name="newName">nouveau nom</param>
        public void ModifyCategoryName(string oldName ,string newName)
        {
            db.dbRun("UPDATE categorie SET nom = @newName Where nom = @oldName", new MySqlParameter[] { new MySqlParameter("@oldName", oldName), new MySqlParameter("@newName", newName) });
        }
    }
}

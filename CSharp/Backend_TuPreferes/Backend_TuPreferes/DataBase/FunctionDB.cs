using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

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
        public List<string[]> GetAllDilemmes()
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
        /// Retourne les dilemmes d'une catégorie
        /// </summary>
        /// <param name="categorie">nom de la categorie</param>
        /// <returns></returns>
        public List<string[]> GetAllDilemmesOfCategorie(string categorie)
        {
            MySqlParameter[] parameters = {
                new MySqlParameter("@id", MySqlDbType.Int32) { Value = GetCategorieByNom(categorie)},
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
        /// <param name="categorie">nom de la categorie</param>
        public void AjouterDilemme(string choix1, string choix2, string categorie)
        {
            MySqlParameter[] parameters = {
                new MySqlParameter("@choix1", MySqlDbType.VarChar) { Value = choix1 },
                new MySqlParameter("@choix2", MySqlDbType.VarChar) { Value = choix2 },
                new MySqlParameter("@idCategorie", MySqlDbType.Int32) { Value = GetCategorieByNom(categorie) }
            };
            db.dbRun("INSERT INTO question (choix1, choix2, idCategorie) VALUES (@choix1, @choix2, @idCategorie)", parameters);
        }

        /// <summary>
        /// Retourne un id de categorie avec le nom
        /// </summary>
        /// <param name="nom">nom de la categorie</param>
        public int GetCategorieByNom(string nom)
        {
            MySqlParameter[] parameters ={
                new MySqlParameter("@nom", MySqlDbType.VarChar) { Value = nom },
            };

            List<string[]> results = db.dbRun("SELECT idCategorie FROM categorie WHERE nom = @nom", parameters);

            if (results.Count == 0)
            {
                return -1;
            }
            return Convert.ToInt32(results[0][0]);
        }

        /// <summary>
        /// Retourne un nom de categorie avec l'id
        /// </summary>
        /// <param name="id">id de la categorie</param>
        public string GetNomCategorieById(int id)
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
        public List<string[]> GetAllCategorie()
        {
            List<string[]> results = db.dbRun("SELECT * FROM categorie");

            if (results != null)
            {
                return results;
            }

            MessageBox.Show("Erreur lors de l'exécution de la requête.");
            return null;
        }
    }
}
